# Reproducer live-component onUpdated bug

In this simple and unnecessary example, we will display a date in either French or English format, depending on the checkbox.

The update of the component's "date" model will be carried out at postMount but also when the "displayAsFrench" model is updated.

### Installation

- composer install
- yarn install --force
- yarn run build
- symfony serve

### Usage

1. Just go to https://127.0.0.1:8000
2. The date is displayed in English format.
3. Click on the “Display as French” checkbox.
4. The onUpdated is triggered, and the code of the onDisplayAsFrenchUpdated method is launched.
5. The date is then updated. The value is dumped, you can find it in the profiler.
6. A dispatchBrowserEvent is fired to update the contents of the HTML, based on the contents of "date", but it retains the old value. (check console)