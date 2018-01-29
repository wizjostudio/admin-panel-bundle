import axios from 'axios'
import Translator from 'bazinga-translator'

class Form {
  constructor(fields, autoNotification, loadedTimeout) {
    this.validated = false
    this.loading = false

    this.loadedTimeout = parseInt(loadedTimeout)
    if (isNaN(this.loadedTimeout) || this.loadedTimeout < 0) {
      this.loadedTimeout = 0
    }

    this.autoNotification = autoNotification

    this.data = {}
    this.errors = {
      '-': []
    }

    fields.forEach(field => {
      this.data[field] = null
      this.errors[field] = []
    })
  }

  hasErrors(field) {
    if (field !== undefined && this.errors[field]) {
      return this.errors[field].length > 0
    }

    return false
  }

  getErrors(field) {
    if (field === undefined) {
      return this.errors
    }

    if (this.errors[field]) {
      return this.errors[field]
    }

    return []
  }

  errorState(field) {
    return this.hasErrors(field) === true ? false : null;
  }

  clearErrors(field) {
    if (field === undefined) {
      for (let key in this.errors) {
        if (this.errors.hasOwnProperty(key)) {
          this.errors[key] = []
        }
      }
    }

    if (this.errors[field]) {
      this.errors[field] = []
    }
  }

  submit(url, method, fields) {
    this.validated = false
    this.loading = true

    let data = this.data
    if (fields !== undefined) {
      data = {}

      for (let key in fields) {
        if (fields.hasOwnProperty(key) && fields[key] && this.data.hasOwnProperty(key)) {
          data[fields[key]] = this.data[key]
        }
      }
    }

    return new Promise((resolve, reject) => {
      axios({
        method: method,
        url: url,
        data: data
      })
      .then(response => {
        this.clearErrors()

        this.validated = false

        if (this.loadedTimeout > 0) {
          setTimeout(
            () => {
              this.loaded()
            },
            this.loadedTimeout
          )
        }

        if (this.autoNotification) {
          $Scriber.notifications.addNotification(
            'success',
            Translator.trans('notification.data_save.success'),
            'check'
          )
        }

        resolve(response)
      })
      .catch(error => {
        if (error.response && error.response.status === 422) {
          this.clearErrors()

          error.response.data.forEach(e => {
            this.errors[e.path].push(e.message ? e.message : '')
          })
        }

        this.loading = false
        this.validated = true

        if (this.autoNotification) {
          $Scriber.notifications.addNotification(
            'danger',
            Translator.trans('notification.data_save.error'),
            'close'
          )
        }

        reject(error)
      })
    })
  }

  loaded() {
    this.loading = false
  }
}

export default Form
