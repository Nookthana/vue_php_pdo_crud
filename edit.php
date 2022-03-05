<?php require './script/header.php'; ?>

<body>


    <div class="container" id="app" >
        <h1>{{text}}</h1>
            <a href="index.php"><button class="btn btn-warning">Back</button></a>
            <form @submit.prevent="submitForm" ref="CreateForm" >
            <div class="form-group" >
                    <label for="ID">ID</label>
                    <input type="text" class="form-control"  v-model="usersFetch.id"  readonly>
                </div>

                <div class="form-group" >
                    <label for="FirstName">FirstName</label>
                    <input type="text" class="form-control"  v-model="usersFetch.fname"  require>
                </div>
                <div class="form-group">
                    <label for="LastName">LastName</label>
                    <input type="text" class="form-control" v-model="usersFetch.lname" placeholder="LastName" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" v-model="usersFetch.email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" v-model="usersFetch.avatar" placeholder="Avatar" required>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>


<?php require './script/script.php'; ?>
<?php require './script/footer.php'; ?>

</body>

<script>

    new Vue({   
                el: "#app",
                data() {
                    return {

                        "text": "Edit users data",
                         usersFetch: []
                    }
                },mounted(){

                    let urlParams = new URLSearchParams(window.location.search);
                    const id = urlParams.get('id');

                    axios.get('Api/user/users_id.php?id='+id)
                         .then( response => { this.usersFetch = response.data.data[0]})        
                         .catch((err => {
                         console.log(err.response.data.message);
                          }))

                           },methods: {
                            submitForm() {

                                  
                                axios.post('Api/user/update.php', this.usersFetch)
                                    .then(response => {
                                        console.log(response);
                                        if(response.data.status == 'ok'){
                                            alert('update success');
                                            window.location.href = "index.php";
                                        }
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                             
                             }

                }
        })

</script>