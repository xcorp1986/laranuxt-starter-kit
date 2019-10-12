import { Plugin } from '@nuxt/types'
import { CmsApi, Configuration } from '~/openapi/src'

declare global {
  namespace NodeJS {
    interface Global {
      FormData: any
    }
  }
}

declare module 'vue/types/vue' {
  interface Vue {
    $cmsApi: CmsApi
  }
}

declare module '@nuxt/types' {
  interface NuxtAppOptions {
    $cmsApi: CmsApi
  }
}

declare module 'vuex/types/index' {
  interface Store<S> {
    $cmsApi: CmsApi
  }
}

const api: Plugin = (context, inject) => {
  const basePath = process.env.API_URL
  let config = new Configuration({ basePath })
  if (process.server) {
    global.FormData = require('form-data')
    config = new Configuration({ fetchApi: fetch, basePath })
  }
  const cmsApi = new CmsApi(config)
  inject('cmsApi', cmsApi)
}

export default api