<template>
    <div class="loginbox">
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
             <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'register' }">create a account</router-link>
            </li>
        </form>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
   
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function (response) {
            if(response.status=="success"){
            alert("ok");
            }
            
            },
            error: function () {},
            
            redirect: '/dashboard',
            fetchUser: true,
        });       
      },
    }
  } 
</script>