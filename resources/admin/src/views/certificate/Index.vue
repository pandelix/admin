<template>
  <page-content>
    <space class="my-1">
      <search-form :fields="search"/>
    </space>

    <a-table
      row-key="id"
      :data-source="certificate"
      bordered
      :scroll="{ x: 600 }"
      :pagination="false"
    >
      <a-table-column title="ID" data-index="id" :width="60"/>
      <a-table-column title="所属公司" data-index="company_name"/>
      <a-table-column title="证件类型" data-index="type_name"/>
      <a-table-column title="证件号" data-index="certificate_no"/>
      <a-table-column title="生效日期" data-index="certificate_valid_from"/>
      <a-table-column title="过期日期" data-index="certificate_valid_to"/>
      <a-table-column title="上次检审日期" data-index="last_inspection_date"/>
      <a-table-column title="下次检审日期" data-index="next_inspection_date"/>
      <a-table-column title="提醒" data-index="remind_count"/>
      <a-table-column title="备注" data-index="remark"/>
      <a-table-column title="操作时间" data-index="updated_at" :width="180"/>
      <a-table-column title="操作人" data-index="operator_name" :width="180"/>
      <a-table-column title="操作" :width="100">
        <template #default="record">
          <space>
            <router-link :to="`/certificate/${record.id}/edit`">编辑</router-link>
            <lz-popconfirm :confirm="destroyCertificate(record.id)">
              <a class="error-color" href="javascript:void(0);">删除</a>
            </lz-popconfirm>
          </space>
        </template>
      </a-table-column>
    </a-table>
    <lz-pagination :page="page"/>
  </page-content>
</template>

<script>
    import LzPagination from '@c/LzPagination'
    import LzPopconfirm from '@c/LzPopconfirm'
    import PageContent from '@c/PageContent'
    import SearchForm from '@c/SearchForm'
    import Space from '@c/Space'
    import {
        destroyCertificate,
        getCertificate,
    } from '@/api/certificate'
    import {removeWhile} from '@/libs/utils'

    export default {
        name: 'Index',
        scroll: true,
        components: {
            LzPopconfirm,
            PageContent,
            LzPagination,
            Space,
            SearchForm,
        },
        data() {
            return {
                search: [
                    {
                        field: 'id',
                        label: 'ID',
                    },
                    {
                        field: 'field_name',
                        label: '字段名',
                    },
                ],
                certificate: [],
                page: null,
            }
        },
        methods: {
            destroyCertificate(id) {
                return async () => {
                    await destroyCertificate(id)
                    this.certificate = removeWhile(this.certificate, (i) => i.id === id)
                }
            },
        },
        watch: {
            $route: {
                async handler(newVal) {
                    const {data: {data, meta}} = await getCertificate(newVal.query)
                    this.certificate = data
                    this.page = meta

                    this.$scrollResolve()
                },
                immediate: true,
            },
        },
    }
</script>
