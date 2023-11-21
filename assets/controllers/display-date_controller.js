// assets/controllers/some-custom-controller.js
// ...
import { Controller } from '@hotwired/stimulus';
import { getComponent } from '@symfony/ux-live-component';

export default class extends Controller {

    async initialize() {
        this.component = await getComponent(this.element);

        // Get live component
        updateValue(this.component);

        this.component.on('render:started', (component) => {
            // do something after the component re-renders
        });

        this.component.on('render:finished', (component) => {
            // loadChart(component);
        });

        window.addEventListener('refresh:date', (event) => {
            updateValue(this.component);
        });

        function updateValue(component) {
            let date = component.getData('date')

            console.log(date);
            document.querySelector('#dateValue').innerHTML = date;
        }
    }
}
