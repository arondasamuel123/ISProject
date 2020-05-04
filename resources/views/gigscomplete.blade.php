<style>
table, th, td {
    border: 1px solid black;
  }
  </style>
<h2>Gigs Completion Rate Report</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Gig Name</th>
        <th scope="col">Gig Duration</th>
        <th scope="col">Is complete</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($gigs as $gig)
        
    
      <tr>
        <td>{{$gig->gig_name}}</td>
        <td>{{$gig->gig_duration}}</td>
        <td>{{$gig->is_complete}}</td>
      </tr>
        
      @endforeach
    </tbody>
  </table>
  <br>
  <br>
  <br>
<strong>Gig Completion rate:</strong> {{$percent}}%
