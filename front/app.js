function ajax_postLogin(state, value) {
	return $.ajax({ method: 'post', url: `${apiUrl}/login`, data: state.loginForm, headers: {
		Authorization: state.authToken || ''
	}})
}
function ajax_postUser(state, value) {
	return $.ajax({ method: 'post', url: `${apiUrl}/users`, data: state.registrationForm, headers: {
		Authorization: state.authToken || ''
	}})
}
function ajax_postMessage(state, value) {
	return $.ajax({ method: 'post', url: `${apiUrl}/messages`, data: Object.assign({'created': moment().format('YYYY-MM-DD HH:mm')}, state.message), headers: {
		Authorization: state.authToken || ''
	}})
}
function ajax_getAllMessage(state, value) {
	return $.ajax({ method: 'get', url: `${apiUrl}/messages`, data: {'dummy':[]}, headers: {
		Authorization: state.authToken || ''
	}})
}
function ajax_postFileUpload(state, value) {
	var formData = new FormData();
	formData.append('file', value);
	return $.ajax({ method: 'post', url: `${apiUrl}/files`, data: formData, 
		processData: false,
		contentType: false,
		headers: {
			Authorization: state.authToken || ''
		}
	})
}

const state = {
	updateHack: false,
	preloader: 0,
	l: null,
	lang: { en: {} }
}

DotObject.str('lang.en.loginForm.username', "Username", state);
DotObject.str('lang.cs.loginForm.username', "Přihlašovací jméno", state);
DotObject.str('lang.en.loginForm.password', "Password", state);
DotObject.str('lang.cs.loginForm.password', "Heslo", state);
DotObject.str('lang.en.loginForm.login', "Log in", state);
DotObject.str('lang.cs.loginForm.login', "Přihlásit se", state);
DotObject.str('lang.en.loginForm.login', "Log in", state);
DotObject.str('lang.cs.loginForm.login', "Přihlásit se", state);
DotObject.str('lang.en.loginForm.registration', "Registration", state);
DotObject.str('lang.cs.loginForm.registration', "Registrace", state);
DotObject.str('lang.en.registrationForm.email', "E-mail", state);
DotObject.str('lang.cs.registrationForm.email', "E-mail", state);
DotObject.str('lang.en.registrationForm.nickname', "Nickname", state);
DotObject.str('lang.cs.registrationForm.nickname', "Přezdívka", state);
DotObject.str('lang.en.registrationForm.username', "Username", state);
DotObject.str('lang.cs.registrationForm.username', "Uživatelské jméno", state);
DotObject.str('lang.en.registrationForm.password', "Password", state);
DotObject.str('lang.cs.registrationForm.password', "Heslo", state);
DotObject.str('lang.en.registrationForm.retype', "Retype password", state);
DotObject.str('lang.cs.registrationForm.retype', "Heslo znovu", state);
DotObject.str('lang.en.registrationForm.button', "Register", state);
DotObject.str('lang.cs.registrationForm.button', "Registrovat", state);
DotObject.str('lang.en.registrationForm.back', "Back", state);
DotObject.str('lang.cs.registrationForm.back', "Zpět", state);
DotObject.str('lang.en.message.add', "Send message", state);
DotObject.str('lang.cs.message.add', "Odeslat zprávu", state);
DotObject.str('lang.en.message.refresh', "Refresh", state);
DotObject.str('lang.cs.message.refresh', "Načíst", state);
DotObject.str('lang.en.week.Mon', "Monday", state);
DotObject.str('lang.cs.week.Mon', "Pondělí", state);
DotObject.str('lang.en.week.Tue', "Tuesday", state);
DotObject.str('lang.cs.week.Tue', "Úterý", state);
DotObject.str('lang.en.week.Wed', "Wednesday", state);
DotObject.str('lang.cs.week.Wed', "Středa", state);
DotObject.str('lang.en.week.Thu', "Thursday", state);
DotObject.str('lang.cs.week.Thu', "Čtvrtek", state);
DotObject.str('lang.en.week.Fri', "Friday", state);
DotObject.str('lang.cs.week.Fri', "Pátek", state);
DotObject.str('lang.en.week.Sat', "Saturday", state);
DotObject.str('lang.cs.week.Sat', "Sobota", state);
DotObject.str('lang.en.week.Sun', "Sunday", state);
DotObject.str('lang.cs.week.Sun', "Neděle", state);

DotObject.str('user', null, state);
DotObject.str('section', "login", state);
DotObject.str('loginForm.username', "", state);
DotObject.str('loginForm.password', "", state);
DotObject.str('registrationForm', {"email":"","nickname":"","username":"","password":"","retype":""}, state);
DotObject.str('message', {"content":"","show_user_id":null,"group_id":null}, state);

state.language = 'cs'
state.l = state.lang[state.language]
state.focus = null

const store = new Vuex.Store({
	state,
	mutations: {
		'initFromGet': function(state, payload) {
			var queryDict = {};
			var setFromUrl = function(item) {
				[key, value] = item.split("=")
				DotObject.str(key, value, state);
			}
			document.cookie.split("; ").forEach(setFromUrl)
			location.search.substr(1).split("&").forEach(setFromUrl)
		},
		'function': function(state, payload) {
		},
		'input': function(state, payload) {
			eval(payload.path + " = \'" + payload.value + "\'");
			state.updateHack = !state.updateHack
		},
		'preloaderAdd': function(state) {
			state.preloader ++
		},
		'preloaderSub': function(state) {
			state.preloader --
		},
		'postFileUpload': function(state) {
			$('[type="file"]').val("");
		},
		'postLogin': function(state, { value, res }) {
			if (res === 0) {
				res = "" + Math.floor(Math.random() * 1000)
			}
			state.authToken = res.authToken
			state.user = res.user
			state.messages = res.messages
			state.users = res.users
			state.updateHack = !state.updateHack
		},
		'setSection': function(state, { value, res }) {
			if (res === 0) {
				res = "" + Math.floor(Math.random() * 1000)
			}
			state.section = value
			state.updateHack = !state.updateHack
		},
		'postUser': function(state, { value, res }) {
			if (res === 0) {
				res = "" + Math.floor(Math.random() * 1000)
			}
			state.registrationForm = {'email':'','nickname':'','username':'','password':'','retype':''}
			state.section = 'login'
			state.updateHack = !state.updateHack
		},
		'postMessage': function(state, { value, res }) {
			if (res === 0) {
				res = "" + Math.floor(Math.random() * 1000)
			}
			helper = Object.assign({}, state.messages)
			helper[res] = Object.assign({'id':res,'user_id': state.user.id, 'created': {'date':moment().format('YYYY-MM-DD HH:mm')}}, state.message)
			state.messages = helper
			state.message = {'content':'','show_user_id':null,'group_id':null}
			state.updateHack = !state.updateHack
		},
		'getAllMessage': function(state, { value, res }) {
			if (res === 0) {
				res = "" + Math.floor(Math.random() * 1000)
			}
			state.messages = res
			state.updateHack = !state.updateHack
		},
	},
	actions: {
		'initFromGet': function({commit, dispatch, state}, value) {
			var queryDict = {};
			var data = document.cookie.split("; ").concat(location.search.substr(1).split("&"))
			data.forEach(function(item) {
				[key, value] = item.split("=")
				queryDict[key] = value
				if (key === 'authToken') {
					dispatch('postLogin')
				}
			})
			commit('initFromGet', queryDict)
		},
		'file-upload': function({commit, dispatch, state}, value) {
			ajax_postFileUpload(state, value).done(res => {
				commit('postFileUpload', { res, value })
				commit('preloaderSub')
			})
		},
		'postLogin': function({commit, state}, value) {
			commit('preloaderAdd')
			ajax_postLogin(state, value).done(res => {
				commit('postLogin', { res, value })
				commit('preloaderSub')
			}).fail(err => {

			})
		},
		'postUser': function({commit, state}, value) {
			commit('preloaderAdd')
			ajax_postUser(state, value).done(res => {
				commit('postUser', { res, value })
				commit('preloaderSub')
			}).fail(err => {

			})
		},
		'postMessage': function({commit, state}, value) {
			commit('preloaderAdd')
			ajax_postMessage(state, value).done(res => {
				commit('postMessage', { res, value })
				commit('preloaderSub')
			}).fail(err => {

			})
		},
		'getAllMessage': function({commit, state}, value) {
			commit('preloaderAdd')
			ajax_getAllMessage(state, value).done(res => {
				commit('getAllMessage', { res, value })
				commit('preloaderSub')
			}).fail(err => {

			})
		},

	}
})

Vue.component(`InitialLoginFormUsernameInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialLoginFormUsernameInputControl form-control" type="text" @input="$store.commit('input', { path: 'state.loginForm.username', value: $event.target.value })" :value="state.loginForm.username" data-test="username"/>`
})

Vue.component(`InitialLoginFormUsernameInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormUsernameInputLabel" v-text="state.l.loginForm.username"/>`
})

Vue.component(`InitialLoginFormUsernameInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormUsernameInput form-group">
		<InitialLoginFormUsernameInputLabel :item="item" :static="static" />
		<InitialLoginFormUsernameInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialLoginFormPasswordInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialLoginFormPasswordInputControl form-control" type="password" @input="$store.commit('input', { path: 'state.loginForm.password', value: $event.target.value })" :value="state.loginForm.password" data-test="password"/>`
})

Vue.component(`InitialLoginFormPasswordInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormPasswordInputLabel" v-text="state.l.loginForm.password"/>`
})

Vue.component(`InitialLoginFormPasswordInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormPasswordInput form-group">
		<InitialLoginFormPasswordInputLabel :item="item" :static="static" />
		<InitialLoginFormPasswordInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialLoginFormLoginRowSendLoginButton`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<button class="InitialLoginFormLoginRowSendLoginButton btn btn-default btn btn-success" v-text="state.l.loginForm.login" data-test="login" @click="$store.dispatch('postLogin', null)"/>`
})

Vue.component(`InitialLoginFormLoginRowSend`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormLoginRowSend col-xs-6">
		<InitialLoginFormLoginRowSendLoginButton />

	</div>`
})

Vue.component(`InitialLoginFormLoginRow`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginFormLoginRow row">
		<InitialLoginFormLoginRowSend />

	</div>`
})

Vue.component(`InitialLoginForm`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLoginForm">
		<InitialLoginFormUsernameInput />
		<InitialLoginFormPasswordInput />
		<InitialLoginFormLoginRow />

	</div>`
})

Vue.component(`InitialLoginRegistration`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<a class="InitialLoginRegistration" href="#" v-text="state.l.loginForm.registration" data-test="registrationLink" @click="$store.commit('setSection', { value: 'registration', res: null })"/>`
})

Vue.component(`InitialLogin`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialLogin" v-if="(state.section === 'login')">
		<InitialLoginForm />
		<InitialLoginRegistration />

	</div>`
})

Vue.component(`InitialRegistrationFormEmailInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialRegistrationFormEmailInputControl form-control" type="text" @input="$store.commit('input', { path: 'state.registrationForm.email', value: $event.target.value })" :value="state.registrationForm.email" data-test="email"/>`
})

Vue.component(`InitialRegistrationFormEmailInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormEmailInputLabel" v-text="state.l.registrationForm.email"/>`
})

Vue.component(`InitialRegistrationFormEmailInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormEmailInput form-group">
		<InitialRegistrationFormEmailInputLabel :item="item" :static="static" />
		<InitialRegistrationFormEmailInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialRegistrationFormNicknameInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialRegistrationFormNicknameInputControl form-control" type="text" @input="$store.commit('input', { path: 'state.registrationForm.nickname', value: $event.target.value })" :value="state.registrationForm.nickname" data-test="nickname"/>`
})

Vue.component(`InitialRegistrationFormNicknameInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormNicknameInputLabel" v-text="state.l.registrationForm.nickname"/>`
})

Vue.component(`InitialRegistrationFormNicknameInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormNicknameInput form-group">
		<InitialRegistrationFormNicknameInputLabel :item="item" :static="static" />
		<InitialRegistrationFormNicknameInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialRegistrationFormUsernameInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialRegistrationFormUsernameInputControl form-control" type="text" @input="$store.commit('input', { path: 'state.registrationForm.username', value: $event.target.value })" :value="state.registrationForm.username" data-test="username"/>`
})

Vue.component(`InitialRegistrationFormUsernameInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormUsernameInputLabel" v-text="state.l.registrationForm.username"/>`
})

Vue.component(`InitialRegistrationFormUsernameInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormUsernameInput form-group">
		<InitialRegistrationFormUsernameInputLabel :item="item" :static="static" />
		<InitialRegistrationFormUsernameInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialRegistrationFormPasswordInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialRegistrationFormPasswordInputControl form-control" type="password" @input="$store.commit('input', { path: 'state.registrationForm.password', value: $event.target.value })" :value="state.registrationForm.password" data-test="password"/>`
})

Vue.component(`InitialRegistrationFormPasswordInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormPasswordInputLabel" v-text="state.l.registrationForm.password"/>`
})

Vue.component(`InitialRegistrationFormPasswordInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormPasswordInput form-group">
		<InitialRegistrationFormPasswordInputLabel :item="item" :static="static" />
		<InitialRegistrationFormPasswordInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialRegistrationFormRetypeInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="InitialRegistrationFormRetypeInputControl form-control" type="password" @input="$store.commit('input', { path: 'state.registrationForm.retype', value: $event.target.value })" :value="state.registrationForm.retype" data-test="retype"/>`
})

Vue.component(`InitialRegistrationFormRetypeInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormRetypeInputLabel" v-text="state.l.registrationForm.retype"/>`
})

Vue.component(`InitialRegistrationFormRetypeInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationFormRetypeInput form-group">
		<InitialRegistrationFormRetypeInputLabel :item="item" :static="static" />
		<InitialRegistrationFormRetypeInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`InitialRegistrationFormRegistrationButton`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<button class="InitialRegistrationFormRegistrationButton btn btn-default btn btn-primary" v-text="state.l.registrationForm.button" data-test="register" @click="$store.dispatch('postUser', null)"/>`
})

Vue.component(`InitialRegistrationForm`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistrationForm">
		<InitialRegistrationFormEmailInput />
		<InitialRegistrationFormNicknameInput />
		<InitialRegistrationFormUsernameInput />
		<InitialRegistrationFormPasswordInput />
		<InitialRegistrationFormRetypeInput />
		<InitialRegistrationFormRegistrationButton />

	</div>`
})

Vue.component(`InitialRegistrationBack`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<a class="InitialRegistrationBack" href="#" v-text="state.l.registrationForm.back" @click="$store.commit('setSection', { value: 'login', res: null })"/>`
})

Vue.component(`InitialRegistration`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="InitialRegistration" v-if="(state.section === 'registration')">
		<InitialRegistrationForm />
		<InitialRegistrationBack />

	</div>`
})

Vue.component(`Initial`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="Initial container" v-if="!(state.user)">
		<InitialLogin />
		<InitialRegistration />

	</div>`
})

Vue.component(`AdminContainerMessagesMessageItemAuthor`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessagesMessageItemAuthor" v-text="state.users[item.user_id].nickname"/>`
})

Vue.component(`AdminContainerMessagesMessageItemCreated`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessagesMessageItemCreated" v-text="moment(item.created.date).format('DD. MM. YYYY HH:mm')"/>`
})

Vue.component(`AdminContainerMessagesMessageItemContent`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessagesMessageItemContent" v-text="item.content"/>`
})

Vue.component(`AdminContainerMessagesMessageItem`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessagesMessageItem">
		<AdminContainerMessagesMessageItemAuthor :item="item" />
		<AdminContainerMessagesMessageItemCreated :item="item" />
		<AdminContainerMessagesMessageItemContent :item="item" />

	</div>`
})

Vue.component(`AdminContainerMessagesMessage`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessagesMessage"><div v-for="(item, id) of state.messages" :key="item.id" >
		<AdminContainerMessagesMessageItem :index="id" :item="item" />
</div>
	</div>`
})

Vue.component(`AdminContainerMessages`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerMessages col-xs-12 col-sm-9">
		<AdminContainerMessagesMessage />

	</div>`
})

Vue.component(`AdminContainerUsers`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerUsers col-xs-12 col-sm-3"/>`
})

Vue.component(`AdminContainerAddMessageMessageInputControl`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<input class="AdminContainerAddMessageMessageInputControl form-control" type="text" @input="$store.commit('input', { path: 'state.message.content', value: $event.target.value })" :value="state.message.content" data-test="message"/>`
})

Vue.component(`AdminContainerAddMessageMessageInputLabel`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerAddMessageMessageInputLabel" v-text="''"/>`
})

Vue.component(`AdminContainerAddMessageMessageInput`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerAddMessageMessageInput form-group">
		<AdminContainerAddMessageMessageInputLabel :item="item" :static="static" />
		<AdminContainerAddMessageMessageInputControl :item="item" :static="static" />

	</div>`
})

Vue.component(`AdminContainerAddMessageAddMessageButton`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<button class="AdminContainerAddMessageAddMessageButton btn btn-default btn btn-primary" v-text="state.l.message.add" data-test="addMessage" @click="$store.dispatch('postMessage', null)"/>`
})

Vue.component(`AdminContainerAddMessage`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainerAddMessage col-xs-12">
		<AdminContainerAddMessageMessageInput />
		<AdminContainerAddMessageAddMessageButton />

	</div>`
})

Vue.component(`AdminContainerRefreshMessagesButton`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<button class="AdminContainerRefreshMessagesButton btn btn-default" v-text="state.l.message.refresh" @click="$store.dispatch('getAllMessage', null)"/>`
})

Vue.component(`AdminContainer`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="AdminContainer row">
		<AdminContainerMessages />
		<AdminContainerUsers />
		<AdminContainerAddMessage />
		<AdminContainerRefreshMessagesButton />

	</div>`
})

Vue.component(`Admin`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="Admin container" v-if="(state.user)">
		<AdminContainer />

	</div>`
})

Vue.component(`app`, {
	props: [ "item", "static", "index" ],
	methods: {
		moment: function(value) { 
			return window.moment(value) 
		}
	},
	computed: {
		state: function() {
			return this.$store.state.updateHack ? this.$store.state : this.$store.state
		}
	},
	template: `<div class="app">
		<Initial />
		<Admin />

	</div>`
})


const VueApp = new Vue({ el: "#app", store,
	mounted: function() {
		this.$store.dispatch('initFromGet')
	},

});