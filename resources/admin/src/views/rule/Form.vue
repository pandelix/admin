<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <a-form-item label="制度名称:" required prop="rule_name">
        <a-input v-model="form.rule_name"/>
      </a-form-item>
      <a-form-item label="简称:" prop="simple_name">
        <a-input v-model="form.simple_name"/>
      </a-form-item>
      <a-form-item label="制度内容" required prop="content">
        <a-input v-model="form.content"/>
      </a-form-item>
      <a-form-item label="状态" required prop="status">
        <a-checkbox :checked="form.status" @change="changeStatus">启用</a-checkbox>
      </a-form-item>
      <a-form-item label="排序" prop="sort">
        <a-input v-model="form.sort"/>
      </a-form-item>
    </lz-form>
  </page-content>
</template>

<script>
    import LzForm from '@c/LzForm'
    import PageContent from '@c/PageContent'
    import {
        createRule,
        editRule,
        storeRule,
        updateRule,
    } from '@/api/rule'

    export default {
        name: 'Form',
        components: {
            LzForm,
            // LzFormItem,
            PageContent,
        },
        data() {
            return {
                form: {
                    rule_name: '',
                    simple_name: '',
                    content: '',
                    status: true,
                    sort: '',
                },
                errors: {},
            }
        },
        methods: {
            async getData($form) {
                let data

                if ($form.realEditMode) {
                    ({data} = await editRule($form.resourceId))
                } else {
                    ({data} = await createRule())
                }

                return data
            },
            async onSubmit($form) {
                if ($form.realEditMode) {
                    this.form.status = this.form.status === true ? 1 : 0;
                    await updateRule($form.resourceId, this.form)
                } else {
                    await storeRule(this.form)
                }
            },

            changeStatus(e) {
                this.form.status = e.target.checked;
            },
        },
    }
</script>
