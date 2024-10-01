document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('.registration-section');
    const buttons = document.querySelectorAll('.step-trigger');
    const nextButtons = document.querySelectorAll('.next-step');
    let currentStep = 0;
    let checkAll = document.getElementById('check-all-term');
    let otherCheckboxes = document.querySelectorAll('input[type=checkbox]:not(#check-all-term)');
    let nextButton = document.querySelector('.shade-orange.btn.mt-5');
    let checkoutButton = document.querySelector('.step[data-target="#checkout-payment"] button');

    checkAll.addEventListener('change', onCheckAllChange);
    otherCheckboxes.forEach(input => input.addEventListener('change', onOtherCheckboxChange));

    function onCheckAllChange() {
        otherCheckboxes.forEach((input) => input.checked = checkAll.checked);
        updateNextButtonState();
    }

    function onOtherCheckboxChange() {
        let allChecked = Array.from(otherCheckboxes).every(input => input.checked);
        checkAll.checked = allChecked;
        updateNextButtonState();
    }

    function updateNextButtonState() {
        let allChecked = Array.from(otherCheckboxes).every(input => input.checked);
        if (allChecked) {
            nextButton.classList.add('btn-selected');
            nextButton.addEventListener('click', onNextButtonClick);
        } else {
            nextButton.classList.remove('btn-selected');
            nextButton.removeEventListener('click', onNextButtonClick);
        }

        buttons.forEach(button => {
            button.disabled = !allChecked;
        });
    }

    function updateStepButtons() {
        let allChecked = Array.from(otherCheckboxes).every(input => input.checked);
        buttons.forEach((button, index) => {
            button.disabled = !allChecked;
            if (allChecked && index === currentStep) {
                button.classList.add('btn-selected');
            } else {
                button.classList.remove('btn-selected');
            }
        });

        if (currentStep === 2) {
            checkoutButton.disabled = !allChecked;
        }
    }


    function onNextButtonClick() {
        if (currentStep < sections.length - 1) {
            currentStep++;
            updateSections();
            updateStepButtons();
        }
    }

    function updateSections() {
        sections.forEach((section, index) => {
            section.style.display = index === currentStep ? 'block' : 'none';
        });
    }

    function updateStepButtons() {
        buttons.forEach((button, index) => {
            if (index === currentStep) {
                button.classList.add('btn-selected');
            } else {
                button.classList.remove('btn-selected');
                if (button.parentElement.getAttribute('data-target') != '#privacy-agreement') {
                    button.disabled = true;
                }
            }
        });

        if (currentStep === 2) {
            checkoutButton.disabled = !Array.from(otherCheckboxes).every(input => input.checked);
        }
    }

    buttons.forEach((button, index) => {
        button.addEventListener('click', () => {

            currentStep = index;
            updateSections();
            updateStepButtons();
        });
    });

    function showMemberInfoSection() {
        const memberInfoSection = document.getElementById('member-info');
        if (memberInfoSection) {
            currentStep = Array.from(sections).indexOf(memberInfoSection);
            updateSections();
            updateStepButtons();
        }
    }

    var nextstep = document.querySelectorAll('.next-page');
    nextstep.forEach(function (element) {
        element.addEventListener('click', function (event) {
            showMemberInfoSection();
        });
    });

    function showThanksInfoSection() {
        const thankpagesection = document.getElementById('thankyou-info');
        if (thankpagesection) {
            const checkoutWizard = document.getElementById('wizard-checkout');
            const checkoutWizardtext = document.getElementById('registerheading');
            currentStep = Array.from(sections).indexOf(thankpagesection);
            updateSections();
            checkoutWizard.style.display = 'none';
            checkoutWizardtext.style.display = 'none';
        }
    }

    // var nextstepThank = document.querySelectorAll('.next-thank-page');
    // nextstepThank.forEach(function (element) {
    //     element.addEventListener('click', function (event) {
    //         showThanksInfoSection();
    //     });
    // });

    updateNextButtonState();
    updateSections();
    updateStepButtons();
});
