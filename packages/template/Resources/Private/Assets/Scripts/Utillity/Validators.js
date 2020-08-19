export const isCompanyName = (value) => {
  return (/^[A-zÀ-ÿ0-9][A-zÀ-ÿ .&0-9]+$/g).test(value)
}

export const isEMailAddress = (value) => {
  let reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  return reg.test(value)
}

export const isPhoneNumber = (value) => {
  return /^(\+)?[0-9 /]+$/g.test(value)
}

export const isEmpty = (value) => {
  return /^$/.test(value)
}

export const notEmpty = (value) => {
  return !isEmpty(value)
}

export const isProperName = (value) => {
  return /^[A-zÀ-ÿ .]{3}[A-zÀ-ÿ .]+$/.test(value)
}
