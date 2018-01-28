import Notifications from './notifications/main'
import Form from './helper/form'

const $Scriber = {
  baseUrl: '/admin'
};

$Scriber.getUrl = (path) => {
  return $Scriber.baseUrl + '/' + path.replace(/^\/+/, '');
}

$Scriber.notifications = Notifications
$Scriber.form = Form

export default $Scriber
