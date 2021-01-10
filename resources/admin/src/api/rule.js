import Request from '@/axios/request'

export function getRule(params) {
  return Request.get('rule', {params})
}

export function createRule() {
  return Request.get('rule/create')
}

export function storeRule(data) {
  return Request.post('rule', data)
}

export function updateRule(id, data) {
  return Request.put(`rule/${id}`, data)
}

export function editRule(id) {
  return Request.get(`rule/${id}/edit`)
}

export function destroyRule(id) {
  return Request.delete(`rule/${id}`)
}
