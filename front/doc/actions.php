<div class="action">
	<h1>Default structure</h1>
		<div>user = null</div>
		<div>section = "login"</div>
		<div>loginForm.username = ""</div>
		<div>loginForm.password = ""</div>
		<div>registrationForm = {"email":"","nickname":"","username":"","password":"","retype":""}</div>
		<div>message = {"content":"","show_user_id":null,"group_id":null}</div>
</div>

	<div class="action">
		<h1>postLogin</h1>
		<p>Ajax: postLogin</p>

			<p>authToken = res.authToken</p>
			<p>user = res.user</p>
			<p>messages = res.messages</p>
			<p>users = res.users</p>
	</div>
	<div class="action">
		<h1>setSection</h1>
		<p></p>

			<p>section = value</p>
	</div>
	<div class="action">
		<h1>postUser</h1>
		<p>Ajax: postUser</p>

			<p>registrationForm = {'email':'','nickname':'','username':'','password':'','retype':''}</p>
			<p>section = 'login'</p>
	</div>
	<div class="action">
		<h1>postMessage</h1>
		<p>Ajax: postMessage</p>

			<p>messages[res] = Object.assign({'id':res,'user_id': state.user.id, 'created': {'date':moment().format('YYYY-MM-DD HH:mm')}}, state.message)</p>
			<p>message = {'content':'','show_user_id':null,'group_id':null}</p>
	</div>
	<div class="action">
		<h1>getAllMessage</h1>
		<p>Ajax: getAllMessage</p>

			<p>messages = res</p>
	</div>
