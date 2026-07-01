
Partial Class TEST
    Inherits System.Web.UI.Page

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        Response.Write("HI")
        Response.Write(Request.QueryString("A"))
        Response.Write(Request.QueryString("B"))
    End Sub
End Class
