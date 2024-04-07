<template>
  <div class="wrapper">
    <navComponent></navComponent>
    <sidemenuComponent></sidemenuComponent>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>&nbsp;</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Logs</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Audit Trail</h3>
            </div>

            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Log</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="e in results">
                      <td>
                        {{ e.action }}
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footerComponent></footerComponent>
  </div>
</template>

<script type="text/javascript">
import api from "../../Helpers/api";
export default {
  created() {
    this.showReport();
  },
  data() {
    return {
      results: [],
    };
  },
  methods: {
    showReport() {
      api
        .post("log-report")
        .then((response) => {
          this.results = response.data;
          Toast.fire({
            icon: "success",
            title: "Saved successfully",
          });
        })
        .catch((error) => {
          
        });
    },
  },
};
</script>
