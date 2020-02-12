/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery');

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});
*/

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'cache-control': 'no-cache',
    Authorization: 'Bearer ' + $('meta[name="api-token"]').attr('content')
  },
  cache: false
});

function resetModal(modal) {
		modal.find('input[type="text"], select').val('');
		modal.find('input[type="checkbox"]').prop('checked', false);
}

$(document).ready(() => {
		$(document).on('click', '.add-user', (e) => {
				let modal = $('.modal#user');

				resetModal(modal);

				modal.find('[name="_method"]').val('POST');
				modal.find('form').attr('action', '/api/users');

				$('.modal#user').modal('show');
				return false;
		});

		$(document).on('click', '.edit-user', (e) => {
				let modal = $('.modal#user');
				resetModal(modal);

				modal.find('form').attr('action', '/api/users/' + $(e.currentTarget).attr('data-id'));
				modal.find('[name="_method"]').val('PATCH');

				$.get('/api/users/' +  + $(e.currentTarget).attr('data-id')).done(({data}) => {
						

						modal.find('[name="first_name"]').val(data.first_name);
						modal.find('[name="last_name"]').val(data.last_name);
						modal.find('[name="email"]').val(data.email);
						modal.find('[name="department_id"]').val(data.department_id);
						modal.find('[name="role_id"]').val(data.role_id);

						modal.modal('show');
				});
				return false;
		});

		$(document).on('click', '.save-user', (e) => {
				$('form[name="user"]').submit();
				return false;
		});

		$('form[name="user"]').submit(function(e) {
	    e.preventDefault(); // avoid to execute the actual submit of the form.

	    var form = $(this);
	    var url = form.attr('action');

	    $('form[name="user"]').find('.error').addClass('d-none');
	    $('form[name="user"]').find('input, button, select').prop('disabled', true);

	    let data = [{
	    		name: 'first_name', 'value': form.find('[name="first_name"]').val(),
	    }, {
	    		name: 'last_name', 'value': form.find('[name="last_name"]').val(),
	    }, {
	    		name: 'email', 'value': form.find('[name="email"]').val(),
	    }, {
	    		name: 'password', 'value': form.find('[name="password"]').val()
	    }, {
	    		name: 'department_id', 'value': form.find('[name="department_id"]').val(),
	    }, {
	    		name: 'role_id', 'value': form.find('[name="role_id"]').val(),
	    }, {
	    		name: '_method', 'value': form.find('[name="_method"]').val()
	    }].concat(
			  form.find('input[type=checkbox]').map(
			    function() {
			        return {"name": this.name, "value": $(this).prop('checked') ? 1 : 0}
			    }).get()
			);

			console.log(data, $(form).serialize());

	    $.ajax({
				type: "POST",
				url: url,
				data: data,
				success: function(data)
				{
				   $('.modal#user').modal('hide');
				   document.location = document.location;
				},

			}).fail(data => {
				let error  = data.responseJSON.errors ? Object.values(data.responseJSON.errors).pop().pop() : 'Неизвестная ошибка';
				$('#user').find('.error').removeClass('d-none');
        $('#user').find('.error').text(error);
        
      }).always(() => {
      		$('form[name="user"]').find('input, button, select').prop('disabled', false);
      });
		});

		$(document).on('click', '.delete-user', (e) => {
				if(!confirm('Удалить пользователя?')) {
						return false;
				}
				$.post('/api/users/' + $(e.currentTarget).attr('data-id'), {
						_method: 'DELETE',
				}).done(() => {
						alert('Пользователь удален');
						document.location = document.location;
				}).fail(data => {

					let error  = data.responseJSON.errors ? Object.values(data.responseJSON.errors).pop().pop() : data.responseJSON.message || 'Неизвестная ошибка';
					alert(error);
				})
				return false;
		});

		/* =========================================== */

		$(document).on('click', '.edit-role', (e) => {
				let modal = $('.modal#role');
				resetModal(modal);

				modal.find('form').attr('action', '/api/roles/' + $(e.currentTarget).attr('data-id'));
				modal.find('[name="_method"]').val('PATCH');

				$.get('/api/roles/' +  + $(e.currentTarget).attr('data-id')).done(({data}) => {
						

						modal.find('[name="name"]').val(data.title);
						data.abilities.forEach((item) => {
								modal.find('[name="abilities['+ item.name +']"]').prop('checked', true);
						});

						modal.modal('show');
				});
				return false;
		});

		$(document).on('click', '.delete-role', (e) => {
				if(!confirm('Удалить роль?')) {
						return false;
				}
				$.post('/api/roles/' + $(e.currentTarget).attr('data-id'), {
						_method: 'DELETE',
				}).done(() => {
						alert('Роль удалена');
						document.location = document.location;
				}).fail(data => {

					let error  = data.responseJSON.errors ? Object.values(data.responseJSON.errors).pop().pop() : data.responseJSON.message || 'Неизвестная ошибка';
					alert(error);
				})
				return false;
		});

		$(document).on('click', '.save-role', (e) => {
				$('form[name="role"]').submit();
				return false;
		});

		$(document).on('click', '.add-role', (e) => {
				let modal = $('.modal#role');

				resetModal(modal);

				modal.find('[name="_method"]').val('POST');
				modal.find('form').attr('action', '/api/roles');

				$('.modal#role').modal('show');
				return false;
		});

		$('form[name="role"]').submit(function(e) {
	    e.preventDefault(); // avoid to execute the actual submit of the form.

	    var form = $(this);
	    var url = form.attr('action');

	    $('form[name="role"]').find('.error').addClass('d-none');
	    $('form[name="role"]').find('input, button').prop('disabled', true);

	    let data = [{
	    		name: 'name', 'value': form.find('[name="name"]').val(),
	    }, {
	    		name: '_method', 'value': form.find('[name="_method"]').val()
	    }].concat(
			  form.find('input[type=checkbox]').map(
			    function() {
			        return {"name": this.name, "value": $(this).prop('checked') ? 1 : 0}
			    }).get()
			);

			console.log(data, $(form).serialize());

	    $.ajax({
				type: "POST",
				url: url,
				data: data,
				success: function(data)
				{
				   $('.modal#role').modal('hide');
				   document.location = document.location;
				},

			}).fail(data => {
				let error  = data.responseJSON.errors ? Object.values(data.responseJSON.errors).pop().pop() : 'Неизвестная ошибка';
				$('#role').find('.error').removeClass('d-none');
        $('#role').find('.error').text(error);
        
      }).always(() => {
      		$('form[name="role"]').find('input, button').prop('disabled', false);
      });
		});
})
