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
      sort-by="calories"
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
    </v-data-table>
  </div>
</template>

<script>
import BaseDialog from "@/components/SM/BaseDialog";

const root_item = {
  name: "",
  calories: 0,
  fat: 0,
  carbs: 0,
  protein: 0,
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
        text: "Dessert (100g serving)",
        align: "left",
        sortable: false,
        value: "name",
      },
      { text: "Calories", value: "calories" },
      { text: "Fat (g)", value: "fat" },
      { text: "Carbs (g)", value: "carbs" },
      { text: "Protein (g)", value: "protein" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
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

  created() {
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
    initialize() {
      this.desserts = [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
        },
        {
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
        },
        {
          name: "Cupcake",
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
        },
        {
          name: "Gingerbread",
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
        },
        {
          name: "Jelly bean",
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
        },
        {
          name: "Lollipop",
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
        },
        {
          name: "Honeycomb",
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
        },
        {
          name: "Donut",
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
        },
        {
          name: "KitKat",
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
        },
      ];
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
