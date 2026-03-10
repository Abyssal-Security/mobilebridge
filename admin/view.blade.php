<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Mobile API Bridge</h3>
            </div>
            <form method="POST" action="{{ route('admin.extensions.blueprintmobile.patch') }}">
                <div class="box-body">
                    <p>
                        This extension adds Blueprint-specific endpoints for mobile clients.
                        Your app can then send authenticated requests to:
                    </p>
                    <pre>/api/client/extensions/blueprintmobile
/api/application/extensions/blueprintmobile</pre>

                    <div class="alert alert-info" style="margin-top: 15px;">
                        Use the Client API for production apps and keep debug-oriented metadata disabled unless you are troubleshooting.
                    </div>

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="expose_client_api" value="1" @checked($settings['expose_client_api'])>
                            Enable Client API
                        </label>
                        <p class="text-muted small">Expose Blueprint metadata for keys that start with <code>ptlc_</code>.</p>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="include_extension_config" value="1" @checked($settings['include_extension_config'])>
                            Include <code>conf.yml</code> metadata
                        </label>
                        <p class="text-muted small">Include <code>info</code>, <code>admin</code>, <code>dashboard</code>, <code>data</code>, and <code>requests</code> metadata for each extension.</p>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="include_extension_paths" value="1" @checked($settings['include_extension_paths'])>
                            Include internal extension paths
                        </label>
                        <p class="text-muted small">Useful for debugging only. Recommended to keep disabled by default.</p>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="show_system_meta" value="1" @checked($settings['show_system_meta'])>
                            Include system metadata
                        </label>
                        <p class="text-muted small">Adds Blueprint root and version hints, plus API base routes.</p>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sample Response</h3>
            </div>
            <div class="box-body">
                <pre>{
  "object": "list",
  "meta": {
    "extension": "blueprintmobile"
  },
  "data": [
    {
      "identifier": "some-extension",
      "name": "Some Extension"
    }
  ]
}</pre>
            </div>
        </div>
    </div>
</div>
