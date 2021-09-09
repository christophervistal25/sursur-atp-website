let   currentSectionIndex  = 0;
const NO_OF_WIZARD_SECTION = $('.form-wizard-buttons').length - 1;
const DIGIT_INDEX          = 0;

$('.form-wizard-buttons').click((e) => {
    targetSection       = e.target.getAttribute('data-target');
    targetIndex         = e.target.getAttribute('id').match(/\d+/gi)[DIGIT_INDEX];

    // Set the current section index to clicked button in form wizards button at the top.
    currentSectionIndex = targetIndex;

    previousShowUp();

    setActiveButton();

    isSectionLast();

    $('.section').addClass('hidden');

    $(`#${targetSection}`).removeClass('hidden');
});

$('#btn-next').click((e) => {
    // form wizard last section and user want to submit.
    if(e.target.getAttribute('data-submit') === 'true') {
        $('#formAddNewPersonnel').trigger('submit');
    }

    // Display next section.
    if (NO_OF_WIZARD_SECTION > currentSectionIndex) {
        currentSectionIndex++;

        previousShowUp();

        setActiveButton();

        isSectionLast();

        $('.section').addClass('hidden');

        targetSection = $('.form-wizard-buttons')[currentSectionIndex]
                                        .getAttribute('data-target');

        $(`#${targetSection}`).removeClass('hidden');
    }
});

$('#btn-previous').click((e) => {
    // Display previous section.
    if (NO_OF_WIZARD_SECTION <= currentSectionIndex + 1) {
        currentSectionIndex--;


        previousShowUp();

        setActiveButton();

        isSectionLast();

        $('.section').addClass('hidden');

        targetSection = $('.form-wizard-buttons')[currentSectionIndex]
                                            .getAttribute('data-target');

        $(`#${targetSection}`).removeClass('hidden');
    }
});


/* Zero-Based Index
 Checking if the current section index is greater than 1 or not */
let previousShowUp = () => {
    if (currentSectionIndex >= 1) {
        // Show the previous button
        $('#btn-previous').removeClass('hidden');
    } else {
        $('#btn-previous').addClass('hidden');
    }
};

// Remove active color for all buttons in form wizard
// Just apply the active color to selected button.
let setActiveButton = () => {
    $('.form-wizard-buttons')
        .removeClass('bg-theme-1')
        .addClass('bg-gray-200')
        .removeClass('text-white')
        .addClass('text-gray-600');


    let buttonActive = $(`.form-wizard-buttons`)[currentSectionIndex].getAttribute('id');

    $(`#${buttonActive}`)
        .addClass('bg-theme-1')
        .removeClass('bg-gray-200')
        .addClass('text-white')
        .removeClass('text-gray-600');
};

// Checking if the section in form wizard is last
// If Last change the button next to submit
// otherwise display the default text of button next.
let isSectionLast = () => {
    if(currentSectionIndex == NO_OF_WIZARD_SECTION) {
        $('#btn-next').attr('data-submit', true)
                        .text('Submit');
    } else {
        $('#btn-next').attr('data-submit', false)
                        .text('Next');
    }
};
