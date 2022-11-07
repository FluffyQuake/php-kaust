const authorSelect = document.getElementById('author-dd');

authorSelect.addEventListener('change', function(){
    console.log('You selected: ', this.value, this.option[this.selectedIndex].text);
    let newAuthorDiv = document.querySelector('.author-row').cloneNode(true);
    newAuthorDiv.innerText = this.option

    console.log(document.querySelector('author-dd'));
});