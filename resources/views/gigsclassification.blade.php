<style>
table, th, td {
    border: 1px solid black;
  }
  </style>
<h2>Gigs Classification Report</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Gig Name</th>
        <th scope="col">Gig Description</th>
        <th scope="col">Gig Duration</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($classifications as $classification)
        
    
      <tr>
        <td>{{$classification->gig_name}}</td>
        <td>{{$classification->gig_description}}</td>
        <td>{{$classification->gig_duration}}</td>
      </tr>
        
      @endforeach
    </tbody>
  </table>
  
