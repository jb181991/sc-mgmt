<template>
  <div>
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Personal Information</h3>
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
      <div class="box-body" style="padding:20px;">
        <div class="form-horizontal">
          <div class="form-group">
            <label for="fname" class="col-sm-3 control-label">First Name</label>

            <div class="col-sm-5">
              <input
                type="text"
                name="fname"
                id="fname"
                class="form-control inp"
                placeholder="Juan"
                v-model="info.fname"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                class="form-control inp"
                name="suffix"
                id="suffix"
                v-model="info.suffix"
                placeholder="JR."
              />
            </div>
          </div>
          <div class="form-group">
            <label for="mname" class="col-sm-3 control-label">Middle Name</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="mname"
                id="mname"
                class="form-control inp"
                placeholder="De la"
                v-model="info.mname"
              />
            </div>
          </div>
          <div class="form-group">
            <label for="sname" class="col-sm-3 control-label">Surname</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="sname"
                id="sname"
                class="form-control inp"
                placeholder="Cruz"
                v-model="info.sname"
              />
            </div>
          </div>
          <div class="form-group">
            <label for="dob" class="col-sm-3 control-label">Date of Birth</label>

            <div class="col-sm-7">
              <input type="date" name="dob" id="dob" v-model="info.dob" class="form-control inp" />
            </div>
          </div>
          <div class="form-group">
            <label for="pob" class="col-sm-3 control-label">Place of Birth</label>

            <div class="col-sm-7">
              <input type="text" name="pob" id="pob" v-model="info.pob" class="form-control inp" />
            </div>
          </div>
          <div class="form-group">
            <label for="gender" class="col-sm-3 control-label">Gender</label>

            <div class="col-sm-7">
              <select name="gender" id="gender" v-model="info.gender" class="form-control inp">
                <option value disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="citizenship" class="col-sm-3 control-label">Citizenship</label>

            <div class="col-sm-3">
              <select
                name="citizenship"
                id="citizenship"
                v-model="info.citizenship"
                class="form-control inp"
              >
                <option value disabled selected>Select</option>
                <option value="Filipino">Filipino</option>
                <option value="Dual Citizenship">Dual Citizenship</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select
                name="citizenship_opt"
                id="citizenship_opt"
                v-model="info.citizenship_opt"
                class="form-control inp"
                :disabled="info.citizenship != 'Dual Citizenship'"
              >
                <option value disabled selected>Select</option>
                <option value="by Birth">by Birth</option>
                <option value="by Naturalization">by Naturalization</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select
                name="citizenship_country"
                id="citizenship_country"
                v-model="info.citizenship_country"
                class="form-control inp"
                :disabled="info.citizenship != 'Dual Citizenship'"
              >
                <option value disabled selected>Select</option>
                <option
                  v-for="country in countries"
                  v-bind:value="country.id"
                >{{country.country_name}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="civil_status" class="col-sm-3 control-label">Civil Status</label>

            <div class="col-sm-7">
              <select
                name="civil_status"
                id="civil_status"
                v-model="info.civil_status"
                class="form-control inp"
              >
                <option value disabled selected>Select</option>
                <option value="Single">Single</option>
                <option value="Widowed">Widowed</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Residential Address</label>

            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.residential.house_add"
                class="form-control inp"
                placeholder="House/Block/Lot No."
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                v-model="info.residential.street_add"
                class="form-control inp capitalize"
                placeholder="Street"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                v-model="info.residential.sub_add"
                class="form-control inp capitalize"
                placeholder="Subdivision/Village"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.residential.city_add"
                class="form-control inp capitalize"
                placeholder="City"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.residential.province_add"
                class="form-control inp capitalize"
                placeholder="Province"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                v-model="info.residential.zip_add"
                class="form-control inp"
                placeholder="Zipcode"
                maxlength="4"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Permanent Address
              <br />
              <input type="checkbox" @change="isPermanent" v-model="isChecked" true-value="yes" false-value="no" title="Same as Residential Address" /> (Check if same as Residential)
            </label>

            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.permanent.house_add"
                class="form-control inp"
                placeholder="House/Block/Lot No."
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                v-model="info.permanent.street_add"
                class="form-control inp capitalize"
                placeholder="Street"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                v-model="info.permanent.sub_add"
                class="form-control inp capitalize"
                placeholder="Subdivision/Village"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.permanent.city_add"
                class="form-control inp capitalize"
                placeholder="City"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                v-model="info.permanent.province_add"
                class="form-control inp capitalize"
                placeholder="Province"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                v-model="info.permanent.zip_add"
                class="form-control inp"
                placeholder="Zipcode"
                maxlength="4"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Height, weight, blood type</label>

            <div class="col-sm-2">
              <input
                type="text"
                name="height"
                id="height"
                v-model="info.body_mass.height"
                class="form-control inp"
                placeholder="Height (m)"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="weight"
                id="weight"
                v-model="info.body_mass.weight"
                class="form-control inp"
                placeholder="Weight (kg)"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="blood_type"
                id="blood_type"
                v-model="info.body_mass.blood_type"
                class="form-control inp"
                placeholder="Blood Type"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">GSIS ID No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="gsis"
                id="gsis"
                v-model="info.govt_ids.gsis"
                class="form-control inp"
                placeholder="01234567891"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">PAG-IBIG ID No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="pagibig"
                id="pagibig"
                v-model="info.govt_ids.pagibig"
                class="form-control inp"
                placeholder="32135465432132"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">PhilHealth ID No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="philhealth"
                id="philhealth"
                v-model="info.govt_ids.philhealth"
                class="form-control inp"
                placeholder="32135465432132"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">CR/SSS No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="sss"
                id="sss"
                v-model="info.govt_ids.sss"
                class="form-control inp"
                placeholder="082134554"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">TIN</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="tin"
                id="tin"
                v-model="info.govt_ids.tin"
                class="form-control inp"
                placeholder="046213564"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Agency Employee No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="agency_num"
                id="agency_num"
                v-model="info.agency_num"
                class="form-control inp"
                placeholder="32135465432132"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Contact Information</label>

            <div class="col-sm-2">
              <input
                type="text"
                name="tel_num"
                id="tel_num"
                v-model="info.contact.tel_num"
                class="form-control inp"
                placeholder="(02) 226 446"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="phone_num"
                id="phone_num"
                v-model="info.contact.phone_num"
                class="form-control inp"
                placeholder="09123456789"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="email"
                id="email"
                v-model="info.email"
                class="form-control inp"
                placeholder="Email"
              />
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;" v-on:click="personalInfo">Save</button>
      </div>
    </div>
    <!-- /.Personal Information box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">Family Background</h3>

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
      <div class="box-body" style="padding:20px;">
        <div class="form-horizontal">
          <div class="form-group">
            <label for="spouse_sname" class="col-sm-3 control-label">Spouse Surname</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="spouse_sname"
                id="spouse_sname"
                class="form-control inp"
                placeholder="Juan"
                v-model="family.spouse_sname"
                @change="hasSpouse"
              />
            </div>
          </div>
          <div class="form-group" v-if="display == true">
            <label for="spouse_fname" class="col-sm-3 control-label">Spouse First Name</label>

            <div class="col-sm-5">
              <input
                type="text"
                name="spouse_fname"
                id="spouse_fname"
                class="form-control inp"
                placeholder="Juan"
                v-model="family.spouse_fname"
              />
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control inp" placeholder="JR." />
            </div>
          </div>
          <div class="form-group" v-if="display == true">
            <label for="spouse_mname" class="col-sm-3 control-label">Spouse Middle Name</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="spouse_mname"
                id="spouse_mname"
                class="form-control inp"
                placeholder="de la"
                v-model="family.spouse_mname"
              />
            </div>
          </div>
          <div class="form-group" v-if="display == true">
            <label for="spouse_occupation" class="col-sm-3 control-label">Occupation</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="spouse_occupation"
                id="spouse_occupation"
                class="form-control inp"
                placeholder="Occupation"
                v-model="family.spouse_occupation"
              />
            </div>
          </div>
          <div class="form-group" v-if="display == true">
            <label for="employer_business" class="col-sm-3 control-label">Employer/Business Name</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="employer_business"
                id="employer_business"
                class="form-control inp"
                placeholder="Employer/Business"
                v-model="family.employer"
              />
            </div>
          </div>
          <div class="form-group" v-if="display == true">
            <label for="employer_address" class="col-sm-3 control-label">Employer/Business Info</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="employer_address"
                id="employer_address"
                class="form-control inp"
                placeholder="Business Address"
                v-model="family.employer_add"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="business_telnum"
                id="business_telnum"
                class="form-control inp"
                placeholder="(046) 444 415"
                v-model="family.employer_num"
              />
            </div>
          </div>
          <div class="form-group">
            <button
              type="button"
              v-on:click="addNew('children', 'child')"
              class="btn btn-sm btn-success"
            >Add Children</button>
          </div>
          <div class="form-group" v-for="(child, index) in children" :key="index">
            <label class="col-sm-3 control-label">Full Name of child</label>
            <div class="col-sm-4">
              <input
                v-model="child.childName"
                type="text"
                name="children[][childName]"
                class="form-control inp"
              />
            </div>
            <div class="col-sm-3">
              <input
                v-model="child.childDob"
                type="date"
                name="children[][childDob]"
                class="form-control inp"
                placeholder="Date of Birth"
              />
            </div>
            <div class="col-xs-2">
              <button type="button" v-on:click="removeChild('children',index)" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
          <div class="form-group">
            <label for="father_sname" class="col-sm-3 control-label">Father's Name</label>

            <div class="col-sm-2">
              <input
                type="text"
                name="father_sname"
                id="father_sname"
                class="form-control inp"
                placeholder="Surname"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="father_fname"
                id="father_fname"
                class="form-control inp"
                placeholder="First Name"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="father_fname_suffix"
                id="father_fname_suffix"
                class="form-control inp"
                placeholder="JR.,SR."
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="father_mname"
                id="father_mname"
                class="form-control inp"
                placeholder="Middle Name"
              />
            </div>
          </div>
          <div class="form-group">
            <label for="mother_sname" class="col-sm-3 control-label">Mother's Maiden Name</label>

            <div class="col-sm-2">
              <input
                type="text"
                name="mother_sname"
                id="mother_sname"
                class="form-control inp"
                placeholder="Surname"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="mother_fname"
                id="mother_fname"
                class="form-control inp"
                placeholder="First Name"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="mother_mname"
                id="mother_mname"
                class="form-control inp"
                placeholder="Middle Name"
              />
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" v-on:click="saveData('family')" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Family Background box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">Educational Background</h3>

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
      <div class="box-body" style="padding:20px;">
        <div class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">Elementary</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="school_name"
                id="school_name"
                class="form-control inp"
                placeholder="Name of School"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="course"
                id="course"
                class="form-control inp"
                placeholder="Basic Education/Degree/Course"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-1">
              <input
                type="text"
                name="from_date"
                id="from_date"
                class="form-control inp"
                placeholder="From"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="to_date"
                id="to_date"
                class="form-control inp"
                placeholder="To"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="highlvl"
                id="highlvl"
                class="form-control inp"
                placeholder="Highest Level/Units Earned"
                title="Highest Level/Units Earned"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="yr_grad"
                id="yr_grad"
                class="form-control inp"
                placeholder="Year Graduated"
                title="Year Graduated"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="scholarship"
                id="scholarship"
                class="form-control inp"
                placeholder="Scholarship / Academic Honors Received"
                title="Scholarship / Academic Honors Received"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Secondary</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="sec_school_name"
                id="sec_school_name"
                class="form-control inp"
                placeholder="Name of School"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="sec_course"
                id="sec_course"
                class="form-control inp"
                placeholder="Basic Education/Degree/Course"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-1">
              <input
                type="text"
                name="sec_from_date"
                id="sec_from_date"
                class="form-control inp"
                placeholder="From"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="sec_to"
                id="sec_to"
                class="form-control inp"
                placeholder="To"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="sec_highlvl"
                id="sec_highlvl"
                class="form-control inp"
                placeholder="Highest Level/Units Earned"
                title="Highest Level/Units Earned"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="sec_yr_grad"
                id="sec_yr_grad"
                class="form-control inp"
                placeholder="Year Graduated"
                title="Year Graduated"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="sec_scholarship"
                id="sec_scholarship"
                class="form-control inp"
                placeholder="Scholarship / Academic Honors Received"
                title="Scholarship / Academic Honors Received"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Vocational / Trade Course</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="voc_school_name"
                id="voc_school_name"
                class="form-control inp"
                placeholder="Name of School"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="voc_course"
                id="voc_course"
                class="form-control inp"
                placeholder="Basic Education/Degree/Course"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-1">
              <input
                type="text"
                name="voc_from_date"
                id="voc_from_date"
                class="form-control inp"
                placeholder="From"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="voc_to"
                id="voc_to"
                class="form-control inp"
                placeholder="To"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="voc_highlvl"
                id="voc_highlvl"
                class="form-control inp"
                placeholder="Highest Level/Units Earned"
                title="Highest Level/Units Earned"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="voc_yr_grad"
                id="voc_yr_grad"
                class="form-control inp"
                placeholder="Year Graduated"
                title="Year Graduated"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="voc_scholarship"
                id="voc_scholarship"
                class="form-control inp"
                placeholder="Scholarship / Academic Honors Received"
                title="Scholarship / Academic Honors Received"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">College</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="college_school_name"
                id="college_school_name"
                class="form-control inp"
                placeholder="Name of School"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="college_course"
                id="college_course"
                class="form-control inp"
                placeholder="Basic Education/Degree/Course"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-1">
              <input
                type="text"
                name="college_from_date"
                id="college_from_date"
                class="form-control inp"
                placeholder="From"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="college_to"
                id="college_to"
                class="form-control inp"
                placeholder="To"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="college_highlvl"
                id="college_highlvl"
                class="form-control inp"
                placeholder="Highest Level/Units Earned"
                title="Highest Level/Units Earned"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="college_yr_grad"
                id="college_yr_grad"
                class="form-control inp"
                placeholder="Year Graduated"
                title="Year Graduated"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="college_scholarship"
                id="college_scholarship"
                class="form-control inp"
                placeholder="Scholarship / Academic Honors Received"
                title="Scholarship / Academic Honors Received"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Graduate Studies</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="grad_school_name"
                id="grad_school_name"
                class="form-control inp"
                placeholder="Name of School"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="grad_course"
                id="grad_course"
                class="form-control inp"
                placeholder="Basic Education/Degree/Course"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-1">
              <input
                type="text"
                name="grad_from_date"
                id="grad_from_date"
                class="form-control inp"
                placeholder="From"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="grad_to"
                id="grad_to"
                class="form-control inp"
                placeholder="To"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="grad_highlvl"
                id="grad_highlvl"
                class="form-control inp"
                placeholder="Highest Level/Units Earned"
                title="Highest Level/Units Earned"
              />
            </div>
            <div class="col-sm-1">
              <input
                type="text"
                name="grad_yr_grad"
                id="grad_yr_grad"
                class="form-control inp"
                placeholder="Year Graduated"
                title="Year Graduated"
              />
            </div>
            <div class="col-sm-2">
              <input
                type="text"
                name="grad_scholarship"
                id="grad_scholarship"
                class="form-control inp"
                placeholder="Scholarship / Academic Honors Received"
                title="Scholarship / Academic Honors Received"
              />
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Educational Background box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">Civil Service Eligibility</h3>

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
      <div class="box-body" style="padding:20px;">
        <button
          type="button"
          v-on:click="addNew('cses','cse')"
          class="btn btn-sm btn-success"
        >Add Civil Service Eligibility</button>
        <div class="form-horizontal" v-for="(cse, index) in cses" :key="index">
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <select
                name="cses[][option]"
                id="csc_option"
                class="form-control inp"
                v-model="cse.option"
              >
                <option value="cs">Career Service</option>
                <option value="ra">RA 1080 (Board/Bar) Under Special Laws</option>
                <option value="ces">CES</option>
                <option value="csee">CSEE Barangay Eligibility</option>
                <option value="dl">Driver's License</option>
              </select>
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="cses[][rating]"
                id="rating"
                class="form-control inp"
                placeholder="Rating (If Applicable)"
                v-model="cse.rating"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <input
                type="text"
                name="cses[][place]"
                id="place_of_exam"
                class="form-control inp"
                placeholder="Place of Examination/Conferment"
                v-model="cse.place"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="date"
                name="cses[][dateOfExam]"
                id="date_of_exam"
                class="form-control inp"
                title="Date of Examination/Conferment"
                v-model="cse.dateOfExam"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">License (If Applicable)</label>

            <div class="col-sm-4">
              <input
                type="text"
                name="cses[][licenseNum]"
                id="license_number"
                class="form-control inp"
                placeholder="Number"
                v-model="cse.licenseNum"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="date"
                name="cses[][dateOfValid]"
                id="date_of_validity"
                class="form-control inp"
                title="Date of Validity"
                v-model="cse.dateOfValid"
              />
            </div>
            <div class="col-xs-2">
              <button type="button" v-on:click="removeChild('cses',index)" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Civil Service Eligibility box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">Work Experience</h3>

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
      <div class="box-body" style="padding:20px;">
        <small>
          <h6>
            <i>(Include private employment. Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.</i>
          </h6>
        </small>
        <button
          type="button"
          v-on:click="addNew('works','work')"
          class="btn btn-sm btn-success"
        >Add Work Experience</button>
        <div class="form-horizontal" v-for="(work, index) in works" :key="index">
          <div class="form-group">
            <label class="col-sm-3 control-label">Inclusive Dates</label>

            <div class="col-sm-4">
              <input
                type="date"
                name="works[][dateFrm]"
                id="dateFrm"
                class="form-control inp"
                v-model="work.dateFrm"
                placeholder="Date From"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="date"
                name="works[][dateTo]"
                id="dateTo"
                class="form-control inp"
                v-model="work.dateTo"
                placeholder="Date To"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <input
                type="text"
                name="works[][position]"
                id="position"
                class="form-control inp"
                v-model="work.position"
                placeholder="Position Title (Write in Full)"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="works[][department]"
                id="department"
                class="form-control inp"
                v-model="work.department"
                placeholder="Company/Agency/Office/Department"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <input
                type="text"
                name="works[][payGrade]"
                id="payGrade"
                class="form-control inp"
                v-model="work.payGrade"
                placeholder="Pay Grade"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="works[][salary]"
                id="salary"
                class="form-control inp"
                v-model="work.salary"
                placeholder="Monthly Salary"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <input
                type="text"
                name="works[][statOfAppointment]"
                id="statOfAppointment"
                class="form-control inp"
                v-model="work.statOfAppointment"
                placeholder="Status of Appointment"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="works[][govtService]"
                id="govtService"
                class="form-control inp"
                v-model="work.govtService"
                placeholder="Gov't Service (Y/N)"
              />
            </div>
            <div class="col-xs-2">
              <button type="button" v-on:click="removeChild('works',index)" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Work Experience box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3
          class="box-title"
        >Voluntary Work Or Involvment in Civic / Non-Government / People / Voluntary Organizations</h3>

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
      <div class="box-body" style="padding:20px;">
        <button
          type="button"
          v-on:click="addNew('voluntaryWorks','voluntaryWork')"
          class="btn btn-sm btn-success"
        >Add Voluntary Work</button>
        <div class="form-horizontal" v-for="(voluntaryWork, index) in voluntaryWorks" :key="index">
          <div class="form-group">
            <label class="col-sm-3 control-label">Name & Address of Organization</label>

            <div class="col-sm-7">
              <textarea
                name="voluntaryWorks[][name]"
                class="form-control inp"
                v-model="voluntaryWork.name"
                placeholder="Write in full"
                rows="3"
                style="resize: none;"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Inclusive Dates</label>

            <div class="col-sm-4">
              <input
                type="date"
                name="voluntaryWorks[][dateFrm]"
                id="dateFrm"
                class="form-control inp"
                v-model="voluntaryWork.dateFrm"
                title="Date From"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="date"
                name="voluntaryWorks[][dateTo]"
                class="form-control inp"
                v-model="voluntaryWork.dateTo"
                title="Date To"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-4">
              <input
                type="text"
                name="voluntaryWorks[][natureOfWork]"
                class="form-control inp"
                v-model="voluntaryWork.natureOfWork"
                placeholder="Position / Nature of Work"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="voluntaryWorks[][numberOfHrs]"
                class="form-control inp"
                v-model="voluntaryWork.numberOfHrs"
                placeholder="No. of Hours"
              />
            </div>
            <div class="col-xs-2">
              <button
                type="button"
                v-on:click="removeChild('voluntaryWorks',index)"
                class="btn btn-sm btn-danger"
              >
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Voluntary Work box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3
          class="box-title"
        >Learning and Development (L&D) Interventions / Training Programs Attended</h3>

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
      <div class="box-body" style="padding:20px;">
        <button
          type="button"
          v-on:click="addNew('learnings','learning')"
          class="btn btn-sm btn-success"
        >Add Learning and Development</button>
        <div class="form-horizontal" v-for="(learning, index) in learnings" :key="index">
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >Title of Learning and Development Interventions / Training Programs</label>

            <div class="col-sm-7">
              <textarea
                name="learnings[][title]"
                class="form-control inp"
                v-model="learning.title"
                placeholder="Write in full"
                rows="3"
                style="resize: none;"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Inclusive Dates of Attendance</label>

            <div class="col-sm-4">
              <input
                type="date"
                name="learnings[][dateFrm]"
                id="dateFrm"
                class="form-control inp"
                v-model="learning.dateFrm"
                title="Date From"
              />
            </div>
            <div class="col-sm-3">
              <input
                type="date"
                name="learnings[][dateTo]"
                class="form-control inp"
                v-model="learning.dateTo"
                title="Date To"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Type of LD</label>

            <div class="col-sm-4">
              <input
                name="learnings[][typeOfLD]"
                class="form-control inp"
                v-model="learning.typeOfLD"
                placeholder="Managerial / Supervisory / Technical / etc."
              />
            </div>
            <div class="col-sm-3">
              <input
                type="text"
                name="learnings[][numberOfHrs]"
                class="form-control inp"
                v-model="learning.numberOfHrs"
                placeholder="No. of Hours"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Conducted / Sponsored By</label>

            <div class="col-sm-7">
              <textarea
                name="learnings[][conductedBy]"
                class="form-control inp"
                v-model="learning.conductedBy"
                placeholder="Write in full"
                rows="3"
                style="resize: none;"
              ></textarea>
            </div>
            <div class="col-xs-2">
              <button
                type="button"
                v-on:click="removeChild('learnings',index)"
                class="btn btn-sm btn-danger"
              >
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Learning and Development box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">Other Information</h3>

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
      <div class="box-body" style="padding:20px;">
        <button
          type="button"
          v-on:click="addNew('others','other')"
          class="btn btn-sm btn-success"
        >Add Other Information</button>
        <div class="form-horizontal" v-for="(other, index) in others" :key="index">
          <div class="form-group">
            <label class="col-sm-3 control-label">Special Skills and Hobbies</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="others[][specialSkills]"
                class="form-control inp"
                v-model="other.specialSkills"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Non-academic Distinctions / Recognition</label>

            <div class="col-sm-7">
              <textarea
                name="others[][nonAcademic]"
                class="form-control inp"
                v-model="other.nonAcademic"
                placeholder="Write in full"
                rows="2"
                style="resize: none;"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Membership in Association / Organization</label>

            <div class="col-sm-7">
              <textarea
                name="others[][membership]"
                class="form-control inp"
                v-model="other.membership"
                placeholder="Write in full"
                rows="2"
                style="resize: none;"
              ></textarea>
            </div>
            <div class="col-xs-2">
              <button type="button" v-on:click="removeChild('others',index)" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Other Information box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>

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
      <div class="box-body" style="padding:20px;">
        <div class="form-horizontal">
          <div class="col-sm-10">
            <p>
              <b>Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be apppointed,</b>
            </p>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">a. within the third degree?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="related_third" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="related_third" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="related_third_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >b. within the fourth degree (for Local Government Unit - Career Employees)?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="related_fourth" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="related_fourth" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="related_fourth_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >a. Have you ever been found guilty of any administrative offense?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="guilty" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="guilty" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="guilty_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >b. Have you been criminally charged before any court?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="charged" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="charged" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">If YES, give details:</label>

            <div class="col-sm-2">
              <input type="date" class="form-control inp" name="date_filed" title="Date Filed" />
            </div>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control inp"
                name="status_of_case"
                placeholder="Status of Case/s"
              />
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="convicted" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="convicted" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="convicted_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="separated" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="separated" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="separated_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="candidate" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="candidate" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="candidate_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="resigned" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="resigned" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="resigned_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label
              class="col-sm-3 control-label"
            >Have you acquired the status of an immigrant or permanent resident of another country?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="immigrant" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="immigrant" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="immigrant_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, give details"
              ></textarea>
            </div>
          </div>
          <br />
          <div class="col-sm-10">
            <p>
              <b>Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</b>
            </p>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">a. Are you a member of any indigenous group?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="member" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="member" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="member_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, please specify"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">b. Are you a person with disability?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="disabled_person" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="disabled_person" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="disable_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, please specify ID number"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">c. Are you a solo parent?</label>

            <div class="col-sm-7 py">
              <label>
                <input type="radio" name="solo_parent" value="yes" /> Yes
              </label>
              &nbsp;&nbsp;
              <label>
                <input type="radio" name="solo_parent" value="no" /> No
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>

            <div class="col-sm-7">
              <textarea
                name="solo_parent_reason"
                class="form-control inp"
                rows="2"
                style="resize:none;"
                placeholder="If YES, please specify ID number"
              ></textarea>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.Other Information box -->

    <div class="box box-success" v-if="user_id != ''">
      <div class="box-header with-border">
        <h3 class="box-title">
          References
          <span
            style="color:red;"
          >(Person not related by consanguinity or affinity to applicant / appointee)</span>
        </h3>

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
      <div class="box-body" style="padding:20px;">
        <button type="button" v-on:click="addNew('references','reference')" class="btn btn-sm btn-success">Add Reference</button>
        <div class="form-horizontal" v-for="(reference, index) in references" :key="index">
          <div class="form-group">
            <label class="col-sm-3 control-label">Full Name</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="references[][fullname]"
                class="form-control inp"
                v-model="reference.fullname"
              />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>

            <div class="col-sm-7">
              <textarea
                name="references[][address]"
                class="form-control inp"
                v-model="reference.address"
                rows="2"
                style="resize: none;"
              ></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Tel/Phone No.</label>

            <div class="col-sm-7">
              <input
                type="text"
                name="references[][membership]"
                class="form-control inp"
                v-model="reference.membership"
              />
            </div>
            <div class="col-xs-2">
              <button
                type="button"
                v-on:click="removeReference(index)"
                class="btn btn-sm btn-danger"
              >
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <button class="btn btn-success btn-md" style="width:300px;">Save</button>
      </div>
    </div>
    <!-- /.References box -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      info: {
        fname: "",
        suffix: "",
        mname: "",
        sname: "",
        dob: "",
        pob: "",
        gender: "",
        citizenship: "",
        citizenship_opt: "",
        citizenship_country: "",
        civil_status: "",
        residential: {
          house_add: "",
          street_add: "",
          sub_add: "",
          city_add: "",
          province_add: "",
          zip_add: "",
          address_type: 1
        },
        permanent: {
          house_add: "",
          street_add: "",
          sub_add: "",
          city_add: "",
          province_add: "",
          zip_add: "",
          address_type: 2
        },
        body_mass: {
          height: "",
          weight: "",
          blood_type: ""
        },
        govt_ids: {
          gsis: "",
          pagibig: "",
          philhealth: "",
          sss: "",
          tin: ""
        },
        contact: {
          tel_num: "",
          phone_num: ""
        },
        agency_num: "",
        email: ""
      },
      family: {
        spouse_sname: "",
        spouse_fname: "",
        spouse_mname: "",
        spouse_occupation: "",
        employer: "",
        employer_add: "",
        employer_num: "",
      },
      child: {
        childName: "",
        childDob: ""
      },
      display: true,
      cse: {
        option: "",
        rating: "",
        dateOfExam: "",
        place: "",
        licenseNum: "",
        dateOfValid: ""
      },
      work: {
        dateFrm: "",
        dateTo: "",
        position: "",
        department: "",
        salary: "",
        payGrade: "",
        statOfAppointment: "",
        govtService: ""
      },
      voluntaryWork: {
        name: "",
        dateFrm: "",
        dateTo: "",
        numberOfHrs: "",
        natureOfWork: ""
      },
      learning: {
        title: "",
        dateFrm: "",
        dateTo: "",
        numberOfHrs: "",
        typeOfLD: "",
        conductedBy: ""
      },
      other: {
        specialSkills: "",
        nonAcademic: "",
        membership: ""
      },
      reference: {
        fullname: "",
        address: "",
        telNo: ""
      },
      references: [],
      others: [],
      learnings: [],
      voluntaryWorks: [],
      works: [],
      children: [],
      cses: [],
      countries: [],
      isChecked: false,
      url: "http://localhost/rsis",
      user_id: ""
    };
  },
  mounted() {
    // this.children = JSON.parse(JSON.stringify(this.$el.dataset.children));
    this.loadData();
  },
  methods: {
    personalInfo: function() {
        axios.post(this.url + '/save-info', this.info).then(result => {
            // console.log(result.data.id);
            if(result.data.id == "") {
                this.user_id = result.data.id;
                this.info = "";
            } else {
                this.user_id = "";
            }
        }).catch(function(error){
            console.log(error);
        });
    },
    saveData: function(data) {
        if(data == 'family') {
            this.postFunction('/save-family', {'family': this.family, 'children': this.child});
        }
    },
    postFunction: function(url, data) {
        axios.post(this.url + url, data).then(result => {
            console.log(result);
            // if(result.data.msg == success) {
            //     this.info = null;
            // }
        }).catch(function(error){
            console.log(error);
        });
    },
    addNew: function(data, value) {
      this[data].push(Vue.util.extend({}, this[value]));
    },
    removeChild: function(data,index) {
      Vue.delete(this[data], index);
    },
    hasSpouse: function() {
      if (
        this.spouse_name == "n/a" ||
        this.spouse_name == "N/A" ||
        this.spouse_name == "N/a"
      ) {
        this.display = false;
      } else {
        this.display = true;
      }
    },
    loadData: function() {
      axios
        .get(this.url + "/get-countries")
        .then(data => {
          this.countries = data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    isPermanent: function() {
        if (this.isChecked == 'yes')
        {
            this.info.permanent.house_add = this.info.residential.house_add;
            this.info.permanent.street_add = this.info.residential.street_add;
            this.info.permanent.sub_add = this.info.residential.sub_add;
            this.info.permanent.city_add = this.info.residential.city_add;
            this.info.permanent.province_add = this.info.residential.province_add;
            this.info.permanent.zip_add = this.info.residential.zip_add;
            this.info.residential.address_type = 3;
        } else {
            this.info.permanent.house_add = "";
            this.info.permanent.street_add = "";
            this.info.permanent.sub_add = "";
            this.info.permanent.city_add = "";
            this.info.permanent.province_add = "";
            this.info.permanent.zip_add = "";
            this.info.residential.address_type = 1;
        }
    }
  },
  created() {}
};
</script>

<style>
input[type="radio"] {
  margin-top: -1px;
  vertical-align: middle;
}

.py {
  padding-top: 6px;
}
</style>
