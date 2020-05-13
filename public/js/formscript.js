// ==============================================================
// # FORM VALIDATION
// https://jqueryvalidation.org
// ==============================================================
$(validate => {

    // -----------------------------------------
    // ## FORM VALIDATION => Variables

    let firstName = $("#firstName");
    let lastName = $("#lastName");
    let name = $("#firstName, #lastName");
    let email = $("#emailAddress");
    let phone = $("#phoneNumber");
    let street = $("#addressStreet01");
    let mensajae = $("#mensaje");
    let city = $("#addressCity");
    let zip = $("#addressZIP");
    let submit = $("button[type='submit']");
    let msg = jQuery.validator.format;
  
    form.validate({
      debug: true });
  
  
    // -----------------------------------------
    // ## FORM VALIDATION => Inject letters only method into script
    // thx: https://stackoverflow.com/a/20829959
    jQuery.validator.addMethod("lettersonly", function (value, element) {
      return this.optional(element) || /^[a-z," "]+$/i.test(value);
    });
  
    // -----------------------------------------
    // ## FORM VALIDATION => Rules for firstName and lastName
    // Sets the minimum character length (2) and forces letters only
    name.rules("add", {
      required: true,
      minlength: 2,
      lettersonly: true,
      messages: {
        minlength: msg("Introduce más de un valor"),
        lettersonly: msg("Pfft — vamos, tu nombre no usa números...") } });
  
  
  
    // -----------------------------------------
    // ## FORM VALIDATION => Rules for email
    email.rules("add", {
      required: true,
      email: true });
  
  
    // -----------------------------------------
    // ## FORM VALIDATION => Rules for phone#
    phone.rules("add", {
      required: true,
      phoneUS: true });
  
  
    // ## FORM VALIDATION => Auto format phone number
    // omg thx to https://stackoverflow.com/a/26412752
    // Runs our phone var through an array to auto format it
    $(function () {
      phone.keyup(function () {
        this.value = this.value.replace(/(\d{9})/, '$1');
        //alert ("OK");
      });
    });
  
    // -----------------------------------------
    // ## FORM VALIDATION => Rules for street address
    street.rules("add", {
      required: true,
      minlength: 2,
      messages: {
        minlength: msg("Please enter, at least, two \(2\) characters.") } });
  
      // -----------------------------------------



    // -----------------------------------------
    // ## FORM VALIDATION => Rules for city
    city.rules("add", {
      required: true,
      minlength: 2,
      messages: {
        minlength: msg("Please enter, at least, two \(2\) characters.") } });
  
  
  
    // -----------------------------------------
    // ## FORM VALIDATION => Rules for zip
    zip.rules("add", {
      required: true,
      zipcodeUS: true,
      minlength: 1,
      maxlength: 12,
      messages: {
        minlength: msg("Minimum four \(4\) characters, please."),
        maxlength: msg("Maxmimum twelve \(12\) characters, please."),
        zipcodeUS: msg("El código postal introducido es incorrecto \"12345\"") } });
  
  
  
  });
  
  
  
  
  // ==============================================================
  // # FORM INTERACTION
  // ==============================================================
  // ## FORM INTERACTION => Remove .error on reset click
  $("button[type='reset']").on("click", () => {
    $("input").removeClass("error");
    $("label.error").remove();
    $(".form-element").removeClass("valid");
  });
  
  // -----------------------------------------
  // ## FORM INTERACTION => Submit action
  $(submit => {
  
    // ## FORM INTERACTION => Submit action => Variables
    let button = $("button[type='submit']");
    let formPage = $("#contactForm");
    let form = $("#submissionForm");
    let thx = $("#thankYou");
    let restart = $("#restartForm");
  
    // ## FORM INTERACTION => Submit action => Button click
    button.on("click", e => {
      if (form.valid() === true) {// check if form is valid via validator
        formPage.fadeOut(); // fadeOut contactForm section
        thx.delay(1).fadeIn(); // delay 400ms then fadeIn thankYou section
      } else {
          null; // if form is invalid, do nothing (validator will show errors)
        }
    });
  
    // ## FORM INTERACTION => Submit action => Restart click
    restart.on("click", () => {
      thx.fadeOut(); // fadeOut thankYou section
      formPage.delay(600).fadeIn(); // delay 600ms then fadeIn contactForm section
      form[0].reset(); // reset for fields via fork: stackoverflow.com/a/44307884
    });
  
  });