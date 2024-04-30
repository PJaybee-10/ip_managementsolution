<template>
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">
            <div class="modal-header">
              <slot name="header">Update Status</slot>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="$emit('close')"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <slot name="body">
                <form class="user" @submit.prevent="updatePhic">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="batch">Batch</label>
                      <select id="batch" class="form-control" v-model="form.remarks">
                        <option v-for="e in batches" :value="e.batch" :key="e.id">{{ e.batch }}</option>
                      </select>
                      <input type="hidden" class="form-control" v-model="form.id" />
                    </div>
                    <div class="form-group">
                      <label for="acpn">ACPN</label>
                      <input
                        type="text"
                        id="acpn"
                        class="form-control"
                        placeholder="Enter ACPN Number"
                        v-model="form.acpn"
                      />
                    </div>
                    <div class="form-check">
                      <input
                        type="checkbox"
                        id="status"
                        class="form-check-input"
                        v-model="form.status"
                      />
                      <label class="form-check-label" for="status">Is Paid?</label>
                    </div>
                    <div class="form-check">
                      <input
                        type="checkbox"
                        id="iscash"
                        class="form-check-input"
                        v-model="form.iscash"
                      />
                      <label class="form-check-label" for="iscash">Is Cash?</label>
                    </div>
                    <div class="form-group" v-if="form.iscash">
                      <label for="cash">Cash</label>
                      <input
                        type="text"
                        id="cash"
                        class="form-control"
                        placeholder="Enter Cash"
                        v-model="form.cash"
                      />
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </template>

  <script>
  import api from "../../Helpers/api";

  export default {
    props: {
      sessionid: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        batches: [],
        form: {
          id: this.sessionid,
          remarks: "",
          acpn: "",
          status: false,
          iscash: false,
          cash: 0,
        },
      };
    },
    created() {
      this.getBatches();
      this.getSessionData();
    },
    methods: {
      updatePhic() {
        api.post("phic-update", this.form)
          .then((res) => {
            // Assuming Toast is defined somewhere
            Toast.fire({
              icon: "success",
              title: "Saved successfully",
            });
            // Close modal
            this.$emit("close");
          })
          .catch((error) => {
            console.error("Error updating PHIC:", error);
            // Handle error, show error message to user
          });
      },
      getSessionData() {
        api.get("phic-edit/" + this.form.id)
          .then((response) => {
            console.log(response);
            this.form.status = response.data.status === "PAID";
            this.form.iscash = response.data.iscash;
            this.form.remarks = response.data.remarks;
            this.form.acpn = response.data.acpn_no;
            this.form.cash = response.data.cash;
          })
          .catch((error) => {
            console.error("Error getting session data:", error);
            // Handle error, show error message to user
          });
      },
      getBatches() {
        api.get("/get-batches")
          .then((response) => {
            this.batches = response.data;
          })
          .catch((error) => {
            console.error("Error getting batches:", error);
            // Handle error, show error message to user
          });
      },
    },
  };
  </script>

  <style scoped>
  .container-iframe {
    position: relative;
    overflow: hidden;
    width: 100%;
    padding-top: 56.25%;
  }

  .responsive-iframe {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
  }

  * {
    box-sizing: border-box;
  }

  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
    overflow-x: auto;
  }

  .modal-container {
    width: 75%;
    margin: 149px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
  }

  .modal-body {
    margin: 20px 0;
  }

  .modal-enter {
    opacity: 0;
  }

  .modal-leave-active {
    opacity: 0;
  }

  .modal-enter .modal-container,
  .modal-leave-active .modal-container {
    transform: scale(1.1);
  }
  </style>
