// assets/controllers/phone_number_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input'];

    connect() {
        this.element.addEventListener('input', this.validatePhoneNumber.bind(this));
    }

    validatePhoneNumber(event) {
        let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters

        if (value.length > 9) {
            value = value.slice(0, 9); // Limit to 9 digits
        }

        event.target.value = value;
    }
}
