/* eslint-disable vue/valid-v-slot */
<template>
  <div>
    <v-skeleton-loader
      v-if="loading == true"
      :loading="loading"
      transition="fade-transition"
      type="table"
    >
    </v-skeleton-loader>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="email"
      class="elevation-1"
      v-show="loaded"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title class="text-uppercase"
            >Quản lý chi tiêu</v-toolbar-title
          >
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-btn color="primary" dark class="mb-2 pr-6 pl-6" @click="addItem">
            Thêm&nbsp;<v-icon disabled>mdi-note-plus</v-icon>
          </v-btn>
          <BaseDialog
            @close-dialog="is_open = false"
            :is_open="is_open"
            :editedItem="editedItem"
            :formTitle="formTitle"
            @save="(data) => save(data)"
          />
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Làm mới </v-btn>
      </template>
      <template v-slot:[`item.created_at`]="{ item }">
        <span>{{ moment(item.created_at).format("YYYY-MM-DD") }}</span>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import BaseDialog from "@/components/SM/BaseDialog";
import axios from "axios";
const root_item = {
  firstname: "",
  lastname: "",
  age: 0,
  created_at: "",
};
export default {
  name: "ListComponent",
  components: { BaseDialog },
  data: () => ({
    is_open: false,
    loading: true,
    loaded: false,
    headers: [
      {
        text: "Email",
        align: "left",
        // sortable: false,
        value: "email",
      },
      { text: "First Name", value: "firstname" },
      { text: "Last Name", value: "lastname" },
      { text: "Created", value: "created_at" },
      // { text: "Carbs (g)", value: "carbs" },
      // { text: "Protein (g)", value: "protein" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    // headers: [],

    desserts: [],
    editedIndex: -1,
    editedItem: {
      firstname: "",
      lastname: "",
      age: 0,
      created_at: "",
      // carbs: 0,
      // protein: 0,
    },
    defaultItem: {
      firstname: "",
      lastname: "",
      age: 0,
      created_at: "",
      // carbs: 0,
      // protein: 0,
    },
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Thêm chi tiêu" : "Sửa chi tiêu";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  async created() {
    // const { data } = await axios.get("http://sm-local.com/api/get");
    // for (let property in data) {
    //   this.headers.push({
    //     text: property,
    //     value: property,
    //   });
    // }
    // this.headers.push({
    //   text: "Actions",
    //   value: "actions",
    //   sortable: false,
    // });

    const readyHandler = () => {
      if (document.readyState == "complete") {
        setTimeout(() => {
          this.loading = false;
          this.loaded = true;
        }, 1000);
        document.removeEventListener("readystatechange", readyHandler);
      }
    };

    document.addEventListener("readystatechange", readyHandler);

    readyHandler(); // in case the component has been instantiated lately after loading

    this.initialize();
  },

  methods: {
    async initialize() {
      const { data: user } = await axios.get("http://sm-local.com/api/get");

      this.desserts = user;
    },
    addItem() {
      this.editedItem = root_item;
      this.editedIndex = -1;
      this.is_open = true;
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.is_open = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Bạn có chắc chắn muốn xoá mục này không?") &&
        this.desserts.splice(index, 1);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save(data) {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], data);
      } else {
        this.desserts.push(data);
      }
      this.is_open = false;
    },
  },
};
</script>

<style></style>
