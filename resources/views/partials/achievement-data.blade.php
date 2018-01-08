@if($achievements_data_all)
  <div class="row" id="load">
    @foreach($achievements_data_all as $ach_all)
      @if (count($achievements_data_all) > 0)
        <div class="tile col-xs-12 col-sm-4 col-md-3 m-b-2 text-center">
          <div class="va-container">

            <div class="va-block">
              <div class="va-middle">
                <h5 class="h4 m-y-0">{{ $ach_all->ach_title }}</h5>
                <p class="text-muted m-b-0">{{ $ach_all->ach_subtitle }}</p>
                <small>Awarded on <span class="awarding-date text-danger">{{ date('F d, Y', strtotime($ach_all->ach_date_awarded)) }}</span></small>
                <div class="clear-fix"></div>
                <a href="{{ route('achievements.details', ['id' => $ach_all->achivements_id]) }}" class="btn btn-xs btn-danger m-t-2">View Details</a>
              </div>
            </div>

          </div>
        </div>
      @else
        <div class="tile col-xs-12 col-sm-12 col-md-12 m-b-2 text-center">
          <div class="va-container">
              <p>No Data</p>
          </div>
        </div>

      @endif
    @endforeach

  </div>

  <div class="btn-group pull-right" role="group" aria-label="Pagination">
    {{ $achievements_data_all->links() }}
  </div>
@endif
  