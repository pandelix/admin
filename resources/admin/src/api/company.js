import Request from '@/axios/request'

export function getCompany(params) {
  return Request.get('company', { params })
}

export function createCompany() {
  return Request.get('company/create')
}

export function storeCompany(data) {
  return Request.post('company', data)
}

export function updateCompany(id, data) {
  return Request.put(`company/${id}`, data)
}

export function editCompany(id) {
  return Request.get(`company/${id}/edit`)
}

export function destroyCompany(id) {
  return Request.delete(`company/${id}`)
}
