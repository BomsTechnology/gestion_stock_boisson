<template>
  <ul
    v-show="open"
    class="
      absolute
      w-screen
      max-w-sm
      z-10
      ml-24
      mt-118
      bg-white
      shadow-lg
      h-96 overflow-y-auto
      rounded-lg
      py-1
      text-base
      ring-1 ring-black ring-opacity-5
      overflow-auto
      focus:outline-none
      sm:text-sm
      -translate-x-1/2
    "
    tabindex="-1"
    role="listbox"
    aria-labelledby="listbox-label"
    aria-activedescendant="listbox-option-3"
    
  >
  <div v-if="notifications.length != []">
    <li
      class="text-gray-900 cursor-default select-none relative p-2 rounded-lg"
      id="listbox-option-0"
      role="option"
      v-for="notification in notifications" :key="notification.id"
    >
      <div class="bg-indigo-600 rounded-lg">
        <div class="max-w-7xl mx-auto py-1 px-3">
          <div class="flex items-center justify-between flex-wrap">
            <div
              class="
                order-3
                mt-2
                flex-shrink-0
                w-full
                sm:order-2 sm:mt-0 sm:w-auto
              "
            >
              <span
                class="
                  flex
                  items-center
                  justify-center
                  border border-transparent
                  rounded-md
                  shadow-sm
                  text-sm
                  font-medium
                  text-white
                "
              >
              Il ne reste que {{ notification.quantity }} Cassier <span v-if="notification.quantity > 1">s &nbsp</span>de {{ notification.name }} !!!
              </span>
            </div>
            <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
              <button
              @click="removeNotif(notification)"
                type="button"
                class="
                  -mr-1
                  flex
                  p-2
                  rounded-md
                  hover:bg-indigo-500
                  focus:outline-none focus:ring-2 focus:ring-white
                  sm:-mr-2
                "
              >
                <span class="sr-only">Dismiss</span>

                <svg
                  class="h-6 w-6 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </li>
    </div>
    <div v-else class="h-full flex justify-center items-center p-3">
    <span class="text-xl font-semibold">Aucune Notification</span>
  </div>
  </ul>
  
</template>
<script>

export default {
    props: ['open', 'notifications'],

    setup() {

    },

    methods: {
      removeNotif(notif) {
        let index = this.notifications.indexOf(notif);
        this.notifications.splice(index, 1);
      }
    },

    mounted() {

    }
}
</script>