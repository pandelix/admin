<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="字段名" required prop="field_name">
        <a-input v-model="form.field_name"/>
      </lz-form-item>
    </lz-form>
  </page-content>
</template>

<script>
import LzForm from '@c/LzForm'
import LzFormItem from '@c/LzForm/LzFormItem'
import PageContent from '@c/PageContent'
import {
  createRemind,
  editRemind,
  storeRemind,
  updateRemind,
} from '@/api/remind'

export default {
  name: 'Form',
  components: {
    LzForm,
    LzFormItem,
    PageContent,
  },
  data() {
    return {
      form: {
        field_name: '',
      },
      errors: {},
    }
  },
  methods: {
    async getData($form) {
      let data

      if ($form.realEditMode) {
        ({ data } = await editRemind($form.resourceId))
      } else {
        ({ data } = await createRemind())
      }

      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        await updateRemind($form.resourceId, this.form)
      } else {
        await storeRemind(this.form)
      }
    },
  },
}
</script>
