<template>
  <!-- <div class="container"> -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Add Station</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-remove"></i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Station Name</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Station Geographical Location</label>
            <select name="geoloc" class="form-control" id="geoloc">
              <option value="Luzon">Luzon</option>
              <option value="Visayas">Visayas</option>
              <option value="Mindanao">Mindanao</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Station Region</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Station Phone num</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Station Address</label>
            <textarea name id class="form-control"></textarea>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button class="btn btn-success btn-sm">Save</button>
    </div>
  </div>
  <!-- /.box -->
  <!-- </div> -->
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
