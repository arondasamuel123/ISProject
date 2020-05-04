<template>
     <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Freelancers</h3>

                
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Skills</th>
                    <th>Bio</th>
                    <th>Level Type</th>
                    <th>Status</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="freelancer in freelancers" :key="freelancer.id" >
                    <td>{{freelancer.freelancer_id}}</td>
                    <td>{{freelancer.skills}}</td>
                    <td>{{freelancer.bio}}</td>
                    <td>{{freelancer.level_type}}</td>
                    <td  v-if="freelancer.status == 0"> <span class="label label-primary">Pending</span></td>

                    <td v-if="freelancer.status == 1"> 
                     <span class="label label-success">Approved</span>
                    </td>

                    <td v-if="freelancer.status == 2"> 
                     <span class="label label-danger">Rejected</span>
                    </td>

                    <td> 
                        
                    <a  @click="approveFreelancer(freelancer)" class="btn btn-success" data-toggle="modal" data-target="#edit">EDIT
                    <i class="fa fa-edit"></i>
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
        <h5 class="modal-title" id="UpdateModal">Approve Freelancer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="updateFreelancer">
      <div class="modal-body">
        <div class="form-group float-label-control">
                    <label for="name">Skills:</label>
                    <input v-model="form.skills" type="text" name="skills"  class="form-control" :class="{ 'is-invalid': form.errors.has('skills') }">
                    <has-error :form="form" field="skills"></has-error>
                </div>
         


                <div class="form-group">
                <label>Bio:</label>
                <textarea v-model="form.bio"  name="bio" rows="5" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" ></textarea>
                    <has-error :form="form" field="bio"></has-error>
                    </div>
                <div class="form-group">
                <label for="level_type">Level type:</label>
                    <select v-model="form.level_type"  name="level_type" class="form-control" :class="{ 'is-invalid': form.errors.has('level_type') }">
                     
                    <option>Entry</option>
                     <option>Intermediate</option>
                     <option>Expert</option>
                    </select>
                    <has-error :form="form" field="level_type"></has-error>

                    </div>

                            <div class="form-group">
                          <label>Approval:</label>
                          <select v-model="form.status" name="status" :class="{ 'is-invalid': form.errors.has('status') }" >
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                          
                          </select>
                          <has-error :form="form" field="status"></has-error>
                      </div>
                    <br>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Approve</button>
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
                freelancers:{},

                form: new Form({
                    freelancer_id: '',
                    skills:'',
                    bio:'',
                    level_type:'',
                    status:''
                })
            }
        },
        methods:{
          updateFreelancer(){
              this.form.put("/api/freelancer/"+this.form.freelancer_id)
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
          approveFreelancer(freelancer) {
          this.form.fill(freelancer);
        },
            loadFreelancers(){  
          axios.get("/api/freelancer").then(({data}) => {
            return (this.freelancers=data.data);
          });
        },
        
        },
        mounted() {
          this.loadFreelancers();
        }
    }
</script>
