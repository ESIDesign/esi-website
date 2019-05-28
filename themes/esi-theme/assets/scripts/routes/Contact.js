import customSelect from 'custom-select';

export default {
  init() {
    const $form = $('.wpcf7-form');
    $form.find('.form-row').on('DOMSubtreeModified', function() {
      let $this = $(this);

      if ( $this.find('.wpcf7-not-valid-tip').length ) {
        console.log('hello', $this);
        $this.find('label').addClass('t-red');
      }

    });

    $form.submit(() => {
      $form.find('label').removeClass('t-red');
    });

    customSelect('select');
  },
};
