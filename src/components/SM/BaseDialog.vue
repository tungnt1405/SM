<template>
  <v-dialog
    :value="is_open"
    max-width="500px"
    @click:outside="clickOutside"
    @keydown.esc="keydownOutside"
    :key="refresh_key"
  >
    <v-card>
      <v-card-title>
        <span class="text-h5">{{ formTitle }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                :value="editedItem.name"
                label="Dessert name"
                @input="updateItem({ property: 'name', data: $event })"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                :value="editedItem.calories"
                label="Calories"
                @input="updateItem({ property: 'calories', data: $event })"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                :value="editedItem.fat"
                label="Fat (g)"
                @input="updateItem({ property: 'fat', data: $event })"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                :value="editedItem.carbs"
                label="Carbs (g)"
                @input="updateItem({ property: 'carbs', data: $event })"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                :value="editedItem.protein"
                label="Protein (g)"
                @input="updateItem({ property: 'protein', data: $event })"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="$emit('save', updated_item)">
          Lưu
        </v-btn>
        <v-btn color="blue darken-1" text @click="$emit('close-dialog')">
          Huỷ bỏ
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "BaseDialog",
  props: {
    is_open: {
      type: Boolean,
      default() {
        return false;
      },
    },
    editedItem: {
      type: Object,
      default() {
        return null;
      },
    },
    formTitle: {
      type: String,
      default() {
        return "";
      },
    },
  },
  data() {
    return { updated_item: this.editedItem, refresh_key: 1 };
  },
  watch: {
    is_open: {
      deep: true,
      handler(data) {
        if (data) {
          ++this.refresh_key;
        }
      },
    },
  },
  methods: {
    clickOutside() {
      this.$emit("close-dialog");
    },
    keydownOutside() {
      this.$emit("close-dialog");
    },

    updateItem({ property, data }) {
      const updated_data = Number(data);
      this.updated_item[property] = isNaN(updated_data) ? data : updated_data;
    },
  },
};
</script>

<style></style>
