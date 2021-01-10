import Request from '@/axios/request'

export function getCompanies(params) {
  return Request.get('companies', { params })
}

export function createCompany() {
  return Request.get('companies/create')
}

export function storeCompany(data) {
  return Request.post('companies', data)
}

export function updateCompany(id, data) {
  return Request.put(`companies/${id}`, data)
}

export function editCompany(id) {
  return Request.get(`companies/${id}/edit`)
}

export function destroyCompany(id) {
  return Request.delete(`companies/${id}`)
}
