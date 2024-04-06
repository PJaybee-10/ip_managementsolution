<template>
  <div class="wrapper">
    <navComponent></navComponent>
    <sidemenuComponent></sidemenuComponent>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2"></div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">&nbsp;</h3>
                  <button
                    type="button"
                    @click="showModal = true"
                    class="btn btn-primary btn-sm pull-left"
                  >
                    Add
                  </button>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>IP Address</th>
                      <th>Comments</th>
                      <th>Actions</th>
                    </tr>
                    <tr v-for="e in filtersearch" :key="e.id">
                      <td>
                        {{ e.ipaddress }}
                      </td>
                      <td>
                        {{ e.desc }}
                      </td>
                      <td>
                        <button type="button" class="btn btn-success">Edit</button>
                      </td>
                    </tr>
                  </table>                                                                                                         
                  <nav aria-label="Page navigation example" class="to-right">
                    <ul class="pagination">
                      <li class="page-item" v-for="(e, index) in this.countRecords">
                        <a class="page-link" @click="getPageNo(index + 1)" href="#">{{
                          index + 1
                        }}</a>
                      </li>
                    </ul>
                  </nav>
                  <nav aria-label="Page navigation example" class="">
                    {{ showing }}
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ipAddressModal
          v-if="showModal"
          @close="showModal = false"
          :sessionid="0"
          v-on:close="todayPatient"
        >
        </ipAddressModal>
      </section>
    </div>
    <footerComponent></footerComponent>
  </div>
</template>
<script type="text/javascript">
import api from "../../Helpers/api";
export default {
  created() {
    this.filterEmployee();
  },
  data() {
    return {
      form: {
        searchTerm2: null,
        start: 0,
      },
      showModal: false,
      ipadd_list: [],
      searchTerm: "",
      countRecords: 0,
      showing: "",
    };
  },
  computed: {
    filtersearch() {
      return this.ipadd_list.filter((e) => {
        return e.ipaddress.match(this.searchTerm);
      });
    },
  },
  methods: {
    filterEmployee() {
      this.ipadd_list = [];
      this.countRecords = null;
      this.form.start = 0;
      this.isHidden = false;
      api
        .post("ipaddress-list", this.form)
        .then((response) => {
          this.ipadd_list = response.data.data;
          this.countRecords = response.data.count;
          this.isHidden = true;
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    getPageNo(id) {
      this.form.start = (id - 1) * 10;
      this.isHidden = false;
      api
        .post("schedule", this.form)
        .then((response) => {
          this.ipadd_list = response.data[0].data;
          this.countRecords = response.data[0].count;
          (this.showing = response.data[0].showing), (this.isHidden = true);
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
