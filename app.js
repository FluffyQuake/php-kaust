const authorSelect = document.getElementById('author-dd');

authorSelect.addEventListener('change', function(){

    console.log('You selected: ', this.value, this.option[this.selectedIndex].text);

    const submitInput = document.querySelector('input[type="submit"]');

    let newAuthorDiv = document.querySelector('.author-row').cloneNode(true);
    newAuthorDiv.querySelector('.author-name').innerText = this.options[this.selectedIndex].text;

    submitInput.parentMode.insertBefore(newAuthorDiv, submitInput);

    const selectedOption = document.querySelector('select option[value="' + this.value +'"]');
    selectedOption.remove();
});