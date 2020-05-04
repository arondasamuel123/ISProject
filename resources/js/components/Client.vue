<template>
    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Clients</h3>

                
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                     <th>ID</th>
                    <th>Company Name</th>
                    <th>Bio</th>
                    <th>KRA Pin</th>
                     <th>Company Certificate</th>
                    <th>Status</th>
                    <th>Modify</th>
                    
                  </tr>
                  <tr v-for="client in clients" :key="client.id">
                     <td>{{client.client_id}}</td>
                    <td>{{client.company_name}}</td>
                    <td>{{client.bio}}</td>
                    <td>{{client.kra_pin}}</td>
                    <td>{{client.company_cert}}</td>
                    <td  v-if="client.status == 0"> <span class="label label-primary">Pending</span></td>
                    <td v-else-if="client.status == 1"> 
                     <span class="label label-success">Approved</span>
                    </td>

                    <td> 
                        
                     <a @click="approveClient(client)" class="btn btn-success" data-toggle="modal" data-target="#edit">EDIT
                    <i class="fa fa-edit"></i>
                    </a>

                    </td>
                    
                    <td> 
                        
                     <a @click="download(client.client_id)" class="btn btn-primary">
                    <i class="fas fa-file-download"></i>
                    </a>

                    </td>
                  </tr>
                  
                  
                   
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="updateClient">
      <div class="modal-body">
        <div class="form-group float-label-control">
                    <label for="name">Company Name:</label>
                    <input v-model="form.company_name" type="text" name="company_name"  class="form-control" :class="{ 'is-invalid': form.errors.has('company_name') }">
                    <has-error :form="form" field="skills"></has-error>
                </div>
         


                <div class="form-group">
                <label>Bio:</label>
                <textarea v-model="form.bio"  name="bio" rows="5" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" ></textarea>
                    <has-error :form="form" field="bio"></has-error>
                    </div>

                <div class="form-group">
                                <label for="kra_pin">KRA PIN:</label>
                                <input v-model="form.kra_pin" type="text" class="form-control" name="kra_pin" :class="{ 'is-invalid': form.errors.has('kra_pin') }">
                                <has-error :form="form" field="kra_pin"></has-error>
                            </div>
                <div class="form-group">
                <label>Approval:</label>
                <select v-model="form.status" name="status">
                  <option value="0">Pending</option>
                  <option value="1" >Approved</option>
                   <option value="2" >Rejected</option>
                 
                </select>
            </div>

                         
                    <br>
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Approve</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {
      data() {
            return {
                clients:{},

                form: new Form({
                    client_id: '',
                    company_name:'',
                    bio:'',
                    kra_pin:'',
                    company_cert:'',
                    status:''
                })
            }
        },
        methods:{
           approveClient(client) {
          this.form.fill(client);
        },
            loadClients(){
          axios.get("/api/client").then(({data}) => {
            return (this.clients=data.data);
          });
        },
        updateClient(){
              this.form.put("/api/client/"+this.form.client_id)
              .then(()=> {
                swal.fire(
                    'Updated!',
                    'User details have been updated.',
                    'success'
                  )

                  $('#edit').modal('hide')
                  
              })
              .catch(() => {
                 swal.fire("Failed","Something went wrong","warning");
              })
          },
          download(id) {
            console.log(id);
              axios({
                    url: 'http://127.0.0.1:8000/api/client/'+id,
                    method: 'GET',
                    responseType: 'blob', // important
                  }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'file.png');
                    document.body.appendChild(link);
                    link.click();
                  });
              

          },
        },


        mounted() {
           this.loadClients(); 
        }
    }
</script>
