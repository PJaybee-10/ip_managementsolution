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
                    <router-link to="/">Home</router-link>
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
                    <tr v-for="(e, index) in results" :key="index">
                      <td>{{ e.action }}</td>
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

  <script>
  import { Toast } from "your-toast-library"; // Import your toast library
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
      async showReport() {
        try {
          const response = await api.post("log-report");
          this.results = response.data;
          Toast.fire({
            icon: "success",
            title: "Saved successfully",
          });
        } catch (error) {
          // Handle error
          console.error("Error fetching log report:", error);
          Toast.fire({
            icon: "error",
            title: "Failed to fetch log report",
          });
        }
      },
    },
  };
  </script>
