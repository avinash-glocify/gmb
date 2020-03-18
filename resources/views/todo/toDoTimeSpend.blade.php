  <div class="table-responsive">
                <table class="table table-bordered" id="DataTable2">
                    <thead>
                      <tr>
                         <th>#</th>
                          <th>Date</th>
                          <th>Who</th>
                          <th>Description</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Billable</th>
                          <th>Time</th>
                          <th>Hours</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($track as $spend)
                      <tr>
                        <td></td>
                        <td>{{$spend->start_date}}</td>
                        <td>{{$spend->first_name." ".$spend->last_name}}</td>
                        <td>{{$spend->description}}</td>
                        <td>{{$spend->start_time}}</td>
                        <td>{{$spend->end_time}}</td>
                        <td>{{$spend->billable}}</td>
                        <td>{{$spend->hours.":".$spend->minuts}}</td>
                        <td>{{$spend->hours}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                
          </div>