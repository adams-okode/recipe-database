<!-- DropZone.vue -->
<template>
  <div
    class="dropzone border-2 border-dashed border-gray-300 rounded-md p-4 text-center"
    :class="{ 'bg-gray-100': isOver }"
    @dragover.prevent
    @dragenter.prevent="handleDragEnter"
    @dragleave.prevent="handleDragLeave"
    @drop.prevent="handleDrop"
  >
    <p class="text-gray-500">
      Drag and drop an image here, or
      <span class="text-indigo-600">browse</span> to upload
    </p>
    <input
      type="file"
      ref="fileInput"
      accept="image/*"
      class="hidden"
      @change="handleFileChange"
    />
    <button
      type="button"
      class="mt-2 p-2 bg-indigo-500 text-white rounded-md"
      @click="triggerFileSelect"
    >
      Choose File
    </button>
    <div v-if="file" class="mt-4">
      <p class="text-gray-700">Selected File: {{ file.name }}</p>
      <img
        :src="fileUrl"
        alt="Preview"
        class="mt-2 max-w-full h-auto rounded-md"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

const file = ref<File | null>(null);
const fileUrl = ref<string | undefined>();
const isOver = ref(false);
const fileInput = ref<HTMLInputElement | null>(null);

const emit = defineEmits(["file-added"]);

const handleDragEnter = () => {
  isOver.value = true;
};

const handleDragLeave = () => {
  isOver.value = false;
};

const handleDrop = (event: DragEvent) => {
  isOver.value = false;
  if (event.dataTransfer && event.dataTransfer.files.length > 0) {
    const droppedFile = event.dataTransfer.files[0];
    if (droppedFile.type.startsWith("image/")) {
      file.value = droppedFile;
      fileUrl.value = URL.createObjectURL(droppedFile);
      emitFile();
    }
  }
};

const handleFileChange = (event: Event) => {
  const input = event.target as HTMLInputElement;
  if (input.files && input.files.length > 0) {
    const selectedFile = input.files[0];
    if (selectedFile.type.startsWith("image/")) {
      file.value = selectedFile;
      fileUrl.value = URL.createObjectURL(selectedFile);
      emitFile();
    }
  }
};

const triggerFileSelect = () => {
  fileInput.value?.click();
};

const emitFile = () => {
  if (file.value) {
    // Emit the file to the parent component
    emit("file-added", file.value);
  }
};
</script>

<style scoped>
.dropzone {
  transition: background-color 0.3s ease-in-out;
}
</style>
