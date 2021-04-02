<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <lz-form-item label="类型名称" required prop="name">
        <a-input v-model="form.name"/>
      </lz-form-item>
      <lz-form-item label="简称" prop="simple_name">
        <a-input v-model="form.simple_name"/>
      </lz-form-item>
      <lz-form-item label="是否可以更改" prop="is_can_edit">
        否　<a-switch v-model="form.is_can_edit"/>　是
      </lz-form-item>
      <lz-form-item label="备注" prop="remark">
        <a-input v-model="form.remark"/>
      </lz-form-item>
    </lz-form>
  </page-content>
</template>

<script>
import LzForm from '@c/LzForm'
import LzFormItem from '@c/LzForm/LzFormItem'
import PageContent from '@c/PageContent'
import {
  createCategory,
  editCategory,
  storeCategory,
  updateCategory,
} from '@/api/category'

export default {
  name: 'category/Form',
  components: {
    LzForm,
    LzFormItem,
    PageContent,
  },
  data() {
    return {
      form: {
        type: 'economic',
        name: '',
        simple_name: '',
        simple_pinyin: '',
        is_can_edit: '1',
        remark: '',
      },
      errors: {},
    }
  },
  methods: {
    async getData($form) {
      let data

      if ($form.realEditMode) {
        ({ data } = await editCategory($form.resourceId))
      } else {
        ({ data } = await createCategory())
      }

      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        await updateCategory($form.resourceId, this.form)
      } else {
        await storeCategory(this.form)
      }
    },
  },
}
</script>
