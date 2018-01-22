import Notifications from './notifications/main'

const $Scriber = {
  baseUrl: '/admin',
  csrfToken: null
};

$Scriber.getUrl = (path) => {
  return $Scriber.baseUrl + '/' + path.replace(/^\/+/, '');
}

$Scriber.notifications = Notifications
$Scriber.$t = Translator

export default $Scriber
