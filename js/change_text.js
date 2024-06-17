$(document).ready(() => {
    $('.questions').on('click', (event) => {
        if($(event.target).hasClass('change_text')) {
            let question_input = $(event.target).siblings('.text_value');
            question_input.attr('readonly', !question_input.attr('readonly'));
            if(!question_input.attr('readonly')) {
                $(event.target).addClass('text-danger');
                $(event.target).removeClass('text-primary');
            } else {
                $(event.target).addClass('text-primary');
                $(event.target).removeClass('text-danger');
            }
        }
    })
})