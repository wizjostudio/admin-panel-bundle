<template>
    <div id="notifications" class="col-12 col-sm-4">
        <transition-group name="notification" tag="div">
            <div v-for="(notification, i) in notifications" :key="i" v-if="notification.show" class="alert" :class="['alert-' + notification.type, {'alert-with-icon': notification.icon }]" role="alert">
                <button type="button" class="close" style="position: absolute; right: 10px; top: 50%; margin-top: -13px; z-index: 1033;" @click="notification.show = false">
                    <i class="material-icons">close</i>
                </button>

                <span v-if="notification.icon" data-notify="icon" class="material-icons">{{ notification.icon }}</span>
                <span v-if="notification.title" data-notify="title">{{ notification.title }}</span>
                <span data-notify="message">{{ notification.message }}</span>
            </div>
        </transition-group>
    </div>
</template>

<script>
  import $Scriber from '../Scriber'
  export default {
    data () {
      return {
        notifications: [],
        timeout: 7000
      }
    },
    methods: {
      addNotification(type, message, icon, title, timeout) {
        const notification = {
          type: type,
          message: message,
          icon: icon,
          title: title,
          show: true,
        }

        if (timeout === undefined) {
          timeout = this.timeout
        }

        if (timeout > 0) {
          setTimeout(() => {
            notification.show = false
          }, timeout)
        }

        this.notifications.push(notification)
      },

      setTimeout(timeout) {
        this.timeout = parseInt(timeout)
      }
    }
  }
</script>
