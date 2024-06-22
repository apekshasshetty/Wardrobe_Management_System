// add_items.js

const form = document.getElementById('upload-form');

form.addEventListener('submit', (e) => {

  let errors = [];

  if (form.elements['color'].value === '') {
    errors.push('Please enter a color');
  }

  if (form.elements['occasion'].value === '') {
    errors.push('Please enter an occasion');
  }

  if (form.elements['weather'].value === '') {
    errors.push('Please enter weather');
  }

  if (errors.length > 0) {
    e.preventDefault();
    alert(errors.join('\n'));
  }

});