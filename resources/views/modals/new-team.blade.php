<div class="modal fade" tabindex="-1" role="dialog" id="newTeamModal">
    <div class="modal-dialog">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add new team</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-xs-offset-1" align="center">
                        <form action="{{ route('addteam') }}" method="post">
                             <div class="form-group {{ $errors->has('userid') ? 'has-error' : '' }}">
                                <input class="form-control" type="hidden" name="userid" id="userid" value="{{
                                $user->id }}">
                            </div>
                            <div class="form-group {{ $errors->has('team') ? 'has-error' : '' }}">
                                <label for="admin">Team</label>
                                <select class="form-control" type="team" name="team" id="team" value="{{ Request::old
                                ('team') }}">
                                    @foreach($ddteams as $ddteam)
                                        <option value="{{$ddteam->team}}">{{$ddteam->team}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->