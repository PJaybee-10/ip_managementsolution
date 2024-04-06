<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper modal-lg">
        <div class="modal-container">
          <div class="modal-header">
            <slot name="header" v-if="ipid == 0">Add IP Address</slot>
            <slot name="header" v-else>Edit IP Address</slot>
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
              <form class="user" @submit.prevent="save" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">IP Address</label>
                    <input type="text" class="form-control" v-model="form.ipaddress"/>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Comments</label>
                    <textarea rows="" cols="" class="form-control"  v-model="form.comments"></textarea>
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
    ipid: {
      type: Number,
      default: 0,
    },
  },
  created() {
    if(this.ipid!=0){
      this.getIpaddDetails();
    }
  },
  data() {
    return {
      form: {
        id: this.ipid,
        ipaddress: "",
        comments: "",
      },
    };
  },
  methods: {
    getIpaddDetails() {
      api
        .get("ipaddress-edit/"+this.ipid)
        .then((response) => {
          this.form.ipaddress = response.data.ip_address;
          this.form.comments = response.data.description;
        })
        .catch((error) => {});
    },
    save() {
      if (this.form.ipaddress != "" && this.form.comments != "") {  
        let url = "ipaddress-add";
        if(this.form.id!=0){
          url = "ipaddress-update"
        }
        api
          .post(url, this.form)
          .then((response) => {
            if(this.ipid==0){
            this.form.ipaddress = "";
            this.form.comments = "";
            }
            Toast.fire({
              icon: "success",
              title: "Saved successfully",
            });
          })
          .catch((error) => {});
      } else {
        Toast.fire({
          icon: "error",
          title: "Please check required fields.",
        });
      }
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

/* Then style the iframe to fit in the container div with full height and width */
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
  position: absolute;
  width: 75%;
  height: 46%;
  margin: 149px 309px;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-body {
  margin: 20px 0;
}

/*
           * The following styles are auto-applied to elements with
           * transition="modal" when their visibility is toggled
           * by Vue.js.
           *
           * You can easily play with the modal transition by editing
           * these styles.
           */
.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
