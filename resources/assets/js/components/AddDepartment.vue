<template>
  <!-- <div class="container"> -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Add Divisions</h3>

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
      <div class="row" style="padding:0px 50px;">
        <div class="col-md-12">
          <div class="form-group">
            <!-- <label>Chief</label>
            <input name="chief_name" id="chief_name" class="form-control" />-->
            <select2 :data="data" :value="value" @update="update($event)"></select2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Barangay</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <div class="form-group">
            <label>Province</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <div class="form-group">
            <label>Region</label>
            <input type="text" class="form-control" />
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <span class="pull-right">
        <button class="btn btn-success btn-md">Save</button>
      </span>
    </div>
  </div>
  <!-- /.box -->
  <!-- </div> -->
</template>

<script>
export default {
  data() {
    return {
      value: ["test", "test2", "test3"]
    };
  },
  created() {},
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    update(data) {
      console.log(data);
    }
  }
};
</script>
