import axios from 'axios'
import $Scriber from '../Scriber'

class Form {
  constructor(fields, autoNotification) {
    this.validated = false
    this.loading = false

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
        this.loading = false
        this.validated = true

        if (this.autoNotification) {
          $Scriber.notifications.addNotification(
            'success',
            $Scriber.$t.trans('notification.data_save.success'),
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

        if (this.autoNotification) {
          $Scriber.notifications.addNotification(
            'danger',
            $Scriber.$t.trans('notification.data_save.error'),
            'close'
          )
        }
        reject(error)
      })
      .finally(() => {
        this.loading = false
        this.validated = true
      })
    })
  }
}

export default Form
