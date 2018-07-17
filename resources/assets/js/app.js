require('bootstrap');

$('table.table').on('click', 'tr', function () {
    window.location = $(this).data('url');
});

$('#flash-message').delay(500).fadeIn('normal', function () {
    $(this).delay(2500).fadeOut();
});

$('#add').click(function () {
    // set numbers of elements
    let num = $('.dynamic-fields').length;
    // set new number
    let newNum = Number(num + 1);

    // select last element of form
    let dynamicFields = $('.dynamic-fields:last');

    // create new element
    let newElem = dynamicFields.clone();

    // set new values
    newElem.find('label:first').attr('for', 'service_' + newNum);
    newElem.find('label:last').attr('for', 'price_' + newNum);
    newElem.find('input:first').attr('id', 'service_' + newNum).attr('name', 'service_' + newNum).val(null);
    newElem.find('input:last').attr('id', 'price_' + newNum).attr('name', 'price_' + newNum).val(null);

    // insert new element after last element
    dynamicFields.after(newElem);
});
