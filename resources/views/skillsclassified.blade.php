<style>
        table, th, td {
            border: 1px solid black;
          }
          </style>
        <h2>Skills Classification Report</h2>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Skills</th>
                <th scope="col">Level Type</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($skills as $skill)
                
            
              <tr>
                <td>{{$skill->skills}}</td>
                <td>{{$skill->level_type}}</td>
        
              </tr>
                
              @endforeach
            </tbody>
          </table>
          
        