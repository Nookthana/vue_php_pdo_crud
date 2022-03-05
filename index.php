<?php require './script/header.php'; ?>
<body>
<div class="container" id="app">
    <h1>{{text}}</h1>
    <a href="create.php"><button class="btn btn-success">Create</button></a>
<table class="table">
  <thead>
    <tr> 
      <th scope="col">ID</th>
      <th scope="col">Fname</th>
      <th scope="col">Lname</th>
      <th scope="col">Avatar</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
   <tr v-for="row in users" :key="row.id">
       <td>{{row.id}}</td>
       <td>{{row.fname}}</td>
       <td>{{row.lname}}</td>
       <td><img :src="row.avatar" width="35px"></td>
       <td><a v-bind:href="'edit.php?id='+row.id"><button class="btn btn-info">Edit</button></a></td>
       <td><button class="btn btn-danger" v-on:click="deleteID(row.id)">Delete</button></a></td>
   </tr>
  </tbody>
</table>
</div>

<?php require './script/script.php'; ?>
<?php require './script/footer.php'; ?>

</body>

<script>
        new Vue({
            el: "#app",
            data () {
                return {

                    "text": "Rest Api vue + php pdo ",
                     users: [],
                     delete_id: {
                        id: '',
                     }
               

                }
            },mounted(){

              axios.get('Api/user/users_all.php')
              .then( response =>  this.users = response.data.data )
              .catch((err => {
                  console.log(err.response.data.message);
              }))

              
            },methods: {

              deleteID(int) {

                  const id = int;
                  this.delete_id.id = id;

                 // console.log( this.delete_id);

                  if (confirm('Are you sure you want to delete this row ?')) {
 
                        axios.post('Api/user/delete.php', this.delete_id)
                                .then(response => {

                                    if(response.data.status == 'ok'){
                                        alert('delete success');
                                        location.reload();
                                       
                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                  }
                  

              }

            },
        })

</script>