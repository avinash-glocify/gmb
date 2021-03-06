<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
          <table id="simpleEditableTable" class="table table-bordered table-responsive ">
            <thead>
              <tr>
                <th>#</th>
                @foreach(config('projectEnum.finalColumns') as $column)
                  <th>{{ $column }}</th>
                @endforeach
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              @foreach($projectWithVerifyStatus as $key => $project)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $project->email }}</td>
                <td>{{ $project->phone_number }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="store_code"> {{ $project->store_code }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="business_name">{{ $project->business_name }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="address_line_1">{{ $project->address_line_1 }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="address_line_2">{{ $project->address_line_2 }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="address_line_3">{{ $project->address_line_3 }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="address_line_4">{{ $project->address_line_4 }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="address_line_5">{{ $project->address_line_5 }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="sub_locality">{{ $project->sub_locality }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="locality">{{ $project->locality }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="administrative_area">{{ $project->administrative_area }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="country_region">{{ $project->country_region }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="postal_code">{{ $project->postal_code }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="latitude">{{ $project->latitude }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="longitude">{{ $project->longitude }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="primary_phone">{{ $project->primary_phone }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="primary_phone">{{ $project->additional_phones }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="website">{{ $project->website }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="primary_category">{{ $project->primary_category }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="additional_categories">{{ $project->additional_categories }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="sunday_hours">{{ $project->sunday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="monday_hours">{{ $project->monday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="tuesday_hours">{{ $project->tuesday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="wednesday_hours">{{ $project->wednesday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="thursday_hours">{{ $project->thursday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="friday_hours">{{ $project->friday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="saturday_hours">{{ $project->saturday_hours }}</td>
                <td class="editMe" data-id="{{ $project->id }}" data-name="special_hours">{{ $project->special_hours }}</td>
                <td><div class="editMe overflow-hidden" style="width:450px;" data-id="{{ $project->id }}" data-name="from_the_business">{{ $project->from_the_business }}</div></td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="logo_photo">{{ $project->logo_photo }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="cover_photo">{{ $project->cover_photo }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="other_photos">{{ $project->other_photos }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="labels">{{ $project->labels }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="adwords_location_extensions_phone">{{ $project->adwords_location_extensions_phone }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="amenities_wi_fi_wi_fi">{{ $project->amenities_wi_fi_wi_fi }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="highlights_women_led_is_owned_by_women">{{ $project->highlights_women_led_is_owned_by_women }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="credit_card_american_express">{{ $project->credit_card_american_express }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="credit_card_master_card">{{ $project->credit_card_master_card }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="credit_card_visa">{{ $project->credit_card_visa }}</td>
                <td class="editMe overflow-hidden" data-id="{{ $project->id }}" data-name="place_page_urls_menu_link_url_menu">{{ $project->place_page_urls_menu_link_url_menu }}</td>
                <td>
                  <div class="form-group mb-0" style="width:170px">
                    <select class="form-control" id="published" data-name="published" data-id="{{ $project->id }}" onchange="updatePayementStatus(event)">
                      <option value="">Select Status</option>
                      @foreach(config('projectEnum.publishedStatus') as $status)
                      <option @if($project->published === $status) Selected @endif value="{{ $status }}">{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </td>
                <td><a href="{{ route('project-final-export', [$project->id])}}" class="btn btn-success p-2" title="Export">Export</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-5 float-right">
            {{ $projectWithVerifyStatus->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
