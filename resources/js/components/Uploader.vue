<template>
    <div class="uploader bg-white overflow-hidden shadow rounded-lg p-4 my-4">
        <div id="vorschausvg" :style="'background-image:url(\'/storage/'+ value + '\'); background-size:cover;height:200px;'" class="w-full flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="text-center my-auto align-bottom rounded bg-gray-100 p-4 bg-opacity-75">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="mt-1 text-sm text-gray-600">
                    <span class="my-5">
                      <label for="logo" type="file"
                             class="my-3 cursor-pointer rounded-md shadow-sm py-1 px-2 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Bild hochladen
                      </label>
                    </span>
                    <input type="file" :name="fieldname" id="logo" class="hidden"/>
                </p>
                <p class="mt-3 text-xs text-gray-500">
                    PNG, JPG, GIF bis zu 3MB
                </p>
            </div>
        </div>
        <!--
        <div class="mt-2 flex items-center">
            <img id="blah"
                 class="hidden object-cover max-w-lg flex justify-center border-2 border-gray-300 border-dashed rounded-md"
                 src="#" alt="Vorschaulogo">
            <span class="my-3">
              <label for="logo"
                     class="my-3 cursor-pointer ml-5 rounded-md shadow-sm py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                Anderes Bild hochladen
              </label>
            </span>
        </div>
        -->
    </div>
</template>

<script>
    export default {
        components: {
        },
        props: {
            fieldname: String,
            value: String,
        },
        data: () => ({
            preview: "",
        }),
        computed: {},
        methods: {

        },
        mounted() {

        }
    };
</script>

<style>

</style>
