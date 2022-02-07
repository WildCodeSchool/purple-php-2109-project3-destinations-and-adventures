/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/login.scss';
import './styles/fonts.scss';
import './styles/generalInfo.scss';
import './styles/_navbar.scss';
import './styles/bookings.scss';
import './styles/_accordion.scss';
import './styles/clientPayment.scss';
import './styles/financialInfo.scss';
import './styles/supplierPayment.scss';
import './styles/supplierInformation.scss';
import './styles/dashboard.scss';
import './styles/accountCreation.scss';
import './styles/suppliers.scss';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
});
