window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

const mediaDevices = require('media-device');
const Tesseract = require('tesseract.js');
const Swal = require('sweetalert2');
const yaml = require('js-yaml');


window.axios = require('axios');
window.mediaDevices = mediaDevices;
window.Tesseract = Tesseract;
window.Swal = Swal;
window.yaml = yaml;


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
